<x-consignor-layout>
    <livewire:consignor.product.edit-form :$product />

    <livewire:consignor.product.stock-record-table :$product />
    <livewire:consignor.product.damage-record-table :$product />

    <livewire:consignor.product.add-stock-form :$product />
    <livewire:consignor.product.add-damage-form :$product />
</x-consignor-layout>
