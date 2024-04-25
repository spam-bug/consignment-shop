<div>
    @foreach ($groupedItems as $consignorUsername => $items)
        <div>
            <div class="flex items-center gap-2 border-b border-gray-200 px-4 py-2">
                <p class="font-medium">{{ $consignorUsername }}</p>
            </div>

            <div>
                @foreach ($items as $item)
                    <div class="flex items-center justify-between border-b border-gray-200 p-4">
                        <div class="flex gap-2">
                            <input
                                type="checkbox"
                                wire:model.live="selectedItems"
                                value="{{ $item }}"
                            >
                            <div class="h-16 w-16 overflow-hidden">
                                @if (file_exists(asset($item->product->photos[0])))
                                    <img src="{{ asset($item->product->photos[0]) }}" alt="">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-gray-100">
                                        <i class="fa-regular fa-image text-xl text-gray-300"></i>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <p class="font-medium">{{ $item->product->name }}</p>
                                <div>
                                    <p class="text-sm text-gray-500">Total: <span class="text-rose-600">
                                        @if($item->product->selling_price)
                                            ₱{{ number_format($item->product->selling_price, 2) }}
                                        @else
                                            not set
                                        @endif
                                    </span></p>
                                    <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                </div>
                            </div>
                        </div>

                        <x-button variety="danger" wire:click="delete({{ $item }})"><i class="fa-solid fa-trash"></i></x-button>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    @if (!empty($selectedItems))
        <div class="mt-8 px-4 sm:px-6 lg:px-8">
            <p class="text-lg font-medium">Selected Items: {{ count($selectedItems) }}</p>
            <p class="text-lg font-medium">Total: ₱{{ number_format($totalAmount, 2) }}</p>
            <x-button
                variety="primary"
                class="mt-4"
                wire:click="checkout"
            >Checkout</x-button>
        </div>
    @endif
</div>
