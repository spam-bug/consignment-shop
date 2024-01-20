<div>
    <x-modal :$identifier title="{{ is_null($order) ? '' : strtoupper($order->reference_number) }}">
        @if (!is_null($order))
            <div class="p-4">
                <div class="space-y-2">
                    <div class="flex items-center justify-between gap-8">
                        <p>Order Status</p>
                        <x-status :variety="$order->status->variety()">{{ $order->status->value }}</x-status>
                    </div>

                    <div class="flex items-center justify-between gap-8">
                        <p>Order Date</p>
                        <p>{{ $order->created_at }}</p>
                    </div>

                    <div class="flex items-center justify-between gap-8">
                        <p>Consignor</p>
                        <p>{{ $order->consignor->user->username }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="font-medium">ORDER ITEMS</p>

                    <div class="mt-4 space-y-2">
                        @foreach ($order->items as $item)
                            <div class="flex items-center justify-between gap-8">
                                <p>{{ $item->quantity }} x {{ $item->product->name }}</p>
                                <p>₱{{ number_format($item->total, 2) }}</p>
                            </div>
                        @endforeach

                        <div class="mt-2 flex items-center justify-between gap-8 border-t border-dashed border-gray-200">
                            <p class="text-lg font-medium">TOTAL</p>
                            <p class="text-lg font-medium">₱{{ number_format($order->total, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </x-modal>
</div>
