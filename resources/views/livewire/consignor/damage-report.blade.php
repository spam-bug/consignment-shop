<div>
    <div class="p-4 border-b border-gray-200 grid grid-cols-5">
        <p class="col-span-2">Product</p>
        <p>Damage Quantity</p>
        <p>Damage Total</p>
    </div>

    @foreach ($orders as $order)
        <div>
            <div class="bg-gray-100 border-b border-gray-200 px-4 py-2">
                <p class="font-semibold">{{ strtoupper($order->reference_number) }}</p>
            </div>

            <div>
                @foreach ($order->items as $item)
                    <div class="p-4 border-b border-gray-200 grid grid-cols-5">
                        <p class="col-span-2">{{ $item->product->name }}</p>
                        <p>{{ $item->damage_quantity }}</p>
                        <p>₱{{ number_format($item->damage_quantity * $item->product->price, 2) }}</p>

                        <button class="text-right" wire:click="$dispatch('open-modal', { identifier: 'view-damage', 'order': {{ $order }} })">view</button>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <x-table.pagination :data="$orders" />
</div>
