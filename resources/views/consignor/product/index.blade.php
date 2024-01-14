<x-consignor-layout>
    <div class="flex items-center justify-between p-4 sm:p-6 lg:p-8">
        <x-button.link
            href="{{ route('consignor.products.create') }}"
            wire:navigate
            variety="primary"
        >New Product</x-button.link>
    </div>

    <livewire:consignor.product.listing-table />

    <livewire:consignor.product.add-stock-form />
</x-consignor-layout>
