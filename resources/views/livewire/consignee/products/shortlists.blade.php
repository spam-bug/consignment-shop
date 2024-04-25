<div wire:loaded>
    @foreach ($groupedShortlists as $consignorUsername => $shortlists)
        <div>
            <div class="flex items-center justify-between border-b border-gray-200 px-4 py-2">
                <p class="font-medium">{{ $consignorUsername }}</p>

                <x-button
                    variety="secondary"
                    outline
                    wire:click="processContract('{{ $consignorUsername }}')"
                >Process Contract</x-button>
            </div>

            <div>
                @foreach ($shortlists as $shortlist)
                    <div class="flex items-center justify-between border-b border-gray-200 p-4">
                        <div class="flex gap-2">
                            <div class="h-12 w-12 overflow-hidden">
                                <img src="{{ asset($shortlist->product->photos[0]) }}" alt="">
                            </div>

                            <div>
                                <p class="font-medium">{{ $shortlist->product->name }}</p>
                                <p class="text-rose-600">
                                    @if($shortlist->product->selling_price)
                                        ₱{{ number_format($shortlist->product->selling_price, 2) }}
                                    @else
                                        not set
                                    @endif
                                </p>
                            </div>
                        </div>

                        <x-button variety="danger" wire:click="delete({{ $shortlist }})"><i class="fa-solid fa-trash"></i></x-button>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
