<?php

namespace App\Livewire\Consignee;

use App\Enums\OrderStatus;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.consignee'), Title('Checkout')]
class Checkout extends Component
{
    public array $items = [];
    public $total = 0;

    public string $contact_person = '';
    public string $contact_number = '';
    public string $street = '';
    public string $barangay = '';
    public string $city = '';
    public string $province = '';

    public string $paymentMethod = "cod";

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        if (!session()->has('checkout_items')) {
            $this->redirect(route('consignee.dashboard'));
        }

        foreach (session('checkout_items') as $item) {
            $item = json_decode($item);
            $cart = Cart::find($item->id);
            $this->items[] = $cart;
            $this->total += $cart->total;
        }

        if (Auth::user()->consignee->address()->exists()) {
            $this->fill(Auth::user()->consignee->address->toArray());
        }
    }

    public function incrementQuantity(Cart $cart)
    {
        $product = $cart->product;

        $cart->update([
            'quantity' => $cart->quantity + 1,
            'total' => (float) str_replace(',', '', $product->price) + $cart->total,
        ]);

        $this->dispatch('refresh');
        $this->total += (float) str_replace(',', '', $product->price);
    }

    public function decrementQuantity(Cart $cart)
    {
        if ($cart->quantity === 1) return;

        $product = $cart->product;

        $cart->update([
            'quantity' => $cart->quantity - 1,
            'total' => $cart->total - (float) str_replace(',', '', $product->price),
        ]);

        $this->dispatch('refresh');
        $this->total -= (float) str_replace(',', '', $product->price);
    }

    public function completeOrder()
    {
        $this->validate([
            'contact_person' => ['required', 'alpha_spaces'],
            'contact_number' => ['required', 'ph_mobile_number'],
            'street' => ['required'],
            'barangay' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
        ]);

        Address::updateOrCreate(
            ['consignee_id' => Auth::user()->consignee->id],
            [
                'contact_person' => $this->contact_person,
                'contact_number' => $this->contact_number,
                'street' => $this->street,
                'barangay' => $this->barangay,
                'city' => $this->city,
                'province' => $this->province,
            ]
        );

        $groupedItems = [];

        foreach ($this->items as $item) {
            $key = $item->product->consignor->id;

            if (! isset($groupedItems[$key]['total'])) {
                $groupedItems[$key]['total'] = 0;
            }

            $groupedItems[$key]['items'][] = $item;
            $groupedItems[$key]['total'] += $item->total;
        }

        foreach ($groupedItems as $consignorId => $data) {
            $order = Auth::user()->consignee->orders()->create([
                'consignor_id' => $consignorId,
                'total' => $data['total'],
                'status' => OrderStatus::Pending,
            ]);

            foreach ($data['items'] as $item) {
                $order->items()->create([
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'total' => $item->total,
                ]);

                $item->delete();
            }
        }

        session()->forget('checkout_items');

        $this->redirect(route('consignee.cart'), true);
    }

    public function render()
    {
        return view('livewire.consignee.checkout');
    }
}
