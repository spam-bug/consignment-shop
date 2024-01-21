<div>
    <div class="grid gap-4 p-4 sm:gap-6 sm:p-6 lg:grid-cols-3 lg:gap-8 lg:p-8">
        <div class="aspect-square w-full">
            @if (file_exists(asset($product->photos[0])))
                <img src="{{ asset($product->photos[0]) }}" alt="">
            @else
                <div class="flex h-full w-full items-center justify-center bg-gray-100">
                    <i class="fa-regular fa-image text-4xl text-gray-300"></i>
                </div>
            @endif
        </div>

        <div class="lg:col-span-2">
            <h1 class="text-2xl font-medium sm:text-3xl">{{ $product->name }}</h1>
            <div class="mt-2 flex gap-4 text-sm text-gray-500">
                <p class="border-r border-gray-200 pr-4">{{ $product->category->name }}</p>
                <p>1.1k sold</p>
            </div>
            <p class="mt-4 text-2xl font-medium text-rose-600">{{ $product->unit_price }}</p>
            <div class="mt-8 flex gap-2">
                <x-button.link
                    href="{{ route('consignee.products.look') }}"
                    wire:navigate
                    variety="secondary"
                    outline
                >
                    Back to list
                </x-button.link>

                @if ($product->isShortListed())
                    <x-button variety="primary" disabled>Shortlisted</x-button>
                @else
                    <x-button variety="primary" wire:click="shortList">Add to Shortlist</x-button>
                @endif
            </div>
        </div>
    </div>

    <div class="border-b border-gray-200">
        <div class="flex items-center gap-2 border-y border-gray-200 px-4 py-2 sm:px-6 lg:px-8">
            <i class="fa-solid fa-circle-info"></i>
            <p class="font-medium">Description</p>
        </div>

        <div class="p-4 sm:p-6 lg:p-8">
            {{ $product->description }}
        </div>
    </div>

    <div class="p-4 sm:p-6 lg:p-8">
        <livewire:consignee.products.consignor :consignor="$product->consignor" />
    </div>
</div>
