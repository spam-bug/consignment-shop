<div class="space-y-4 p-4 sm:space-y-6 sm:p-6 lg:space-y-8 lg:p-8">
    <div class="space-y-4 sm:space-y-6 lg:space-y-8">
        <div class="max-w-2xl">
            <x-form.input wire:model.live="search" placeholder="search" />
        </div>

        <div class="flex items-center gap-4">
            <div class="gap flex items-center gap-2">
                <x-form.label>Category</x-form.label>
                <x-form.select wire:model.live="category">
                    <option value="">All</option>
                    @if ($categories->isNotEmpty())
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    @endif
                </x-form.select>
            </div>

            <div class="gap flex items-center gap-2">
                <x-form.label>Price</x-form.label>
                <x-form.select wire:model.live="price">
                    <option value="">All</option>
                    <option value="asc">Low to High</option>
                    <option value="desc">High to Low</option>
                </x-form.select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 sm:gap-6 lg:grid-cols-6 lg:gap-8">
        @forelse ($products as $product)
            <a
                href="{{ route('consignee.products.orderable.preview', $product) }}"
                wire:navigate
                class="inline-block overflow-hidden rounded border border-gray-200 p-4 hover:shadow"
            >
                <div class="aspect-square">
                    @if (file_exists(asset($product->photos[0])))
                        <img src="{{ asset($product->photos[0]) }}" alt="">
                    @else
                        <div class="flex h-full w-full items-center justify-center bg-gray-100">
                            <i class="fa-regular fa-image text-4xl text-gray-300"></i>
                        </div>
                    @endif
                </div>

                <div class="mt-4 grid h-[96px] grid-rows-2">
                    <h6 class="line-clamp-2 font-medium">{{ $product->name }}</h6>

                    <div class="flex w-full items-end justify-between">
                        <p class="font-medium text-rose-600">{{ $product->unit_price }}</p>
                        <p class="text-sm text-gray-500">1.1k sold</p>
                    </div>
                </div>
            </a>
        @empty
        @endforelse
    </div>
</div>
