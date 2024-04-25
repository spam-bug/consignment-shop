<div>
    <x-table>
        <x-slot:header>
            <x-table.heading>Name</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">SKU</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Category</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Original Price</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Selling Price</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Stock</x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Created On</x-table.heading>
            <x-table.heading></x-table.heading>
        </x-slot:header>

        <x-slot:body>
            @forelse ($products as $product)
                <x-table.row>
                    <x-table.column>
                        <div class="flex items-center gap-4">
                            <img
                                src="{{ asset($product->photos[0]) }}"
                                alt="{{ $product->name }} Photos"
                                class="h-14 w-14 rounded object-cover object-center"
                            >
                            <p class="font-medium">{{ $product->name }}</p>
                        </div>
                    </x-table.column>

                    <x-table.column class="hidden lg:table-cell">{{ $product->sku }}</x-table.column>
                    <x-table.column class="hidden lg:table-cell">{{ $product->category_name }}</x-table.column>
                    <x-table.column class="hidden lg:table-cell">{{ $product->unit_price }}</x-table.column>
                    <x-table.column class="hidden lg:table-cell">
                        @if($product->selling_price)
                            ₱{{ number_format($product->selling_price, 2) }}
                        @else
                            not set
                        @endif
                    </x-table.column>
                    <x-table.column class="hidden lg:table-cell">{{ $product->stock }}</x-table.column>
                    <x-table.column>
                        <x-status :variety="$product->status->variety()">{{ $product->status->value }}</x-status>
                        @if ($product->isLowOnStock())
                            <x-status variety="danger">Low on stock</x-status>
                        @endif
                    </x-table.column>
                    <x-table.column class="hidden lg:table-cell">{{ $product->created_at }}</x-table.column>
                    <x-table.column>
                        <x-dropdown>
                            <x-slot:trigger>
                                <i class="fa-solid fa-ellipsis"></i>
                            </x-slot:trigger>

                            <x-slot:menu>
                                <x-dropdown.link :href="route('consignor.products.edit', $product)" wire:navigate>Edit</x-dropdown.link>
                                <x-dropdown.button
                                    x-on:click="$dispatch('open-modal', { identifier: 'add-stock-form', 'product': {{ $product }} })"
                                >
                                    Restock
                                </x-dropdown.button>
                                <x-dropdown.button wire:click="updateStatus({{ $product }})">
                                    {{ $product->status === \App\Enums\ProductStatus::Listed ? 'Unlist' : 'List' }}
                                </x-dropdown.button>
                                <x-dropdown.button wire:click="delete({{ $product }})">Delete</x-dropdown.button>
                            </x-slot:menu>
                        </x-dropdown>
                    </x-table.column>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.column colspan="9" class="text-center text-sm">No data available</x-table.column>
                </x-table.row>
            @endforelse
        </x-slot:body>
    </x-table>

    <x-table.pagination :data="$products" />
</div>
