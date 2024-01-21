<x-consignor-layout>
    <div class="flex items-center justify-between p-4 sm:p-6 lg:p-8">
        <form
            action="{{ route('consignor.reports.products') }}"
            method="POST"
            x-data="{ range: '' }"
            class="flex items-center gap-2"
        >
            @csrf

            <div class="flex items-center gap-2">
                <x-form.label>Range</x-form.label>
                <x-form.select
                    class="max-w-[150px]"
                    x-model="range"
                    name="range"
                >
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                    <option value="custom">Custom</option>
                </x-form.select>
            </div>

            <template x-if="range === 'custom'">
                <div class="flex gap-4">
                    <div class="flex items-center gap-2">
                        <x-form.label>From</x-form.label>
                        <x-form.input type="date" name="from" />
                        <x-form.error for="from" />
                    </div>

                    <div class="flex items-center gap-2">
                        <x-form.label>To</x-form.label>
                        <x-form.input type="date" name="to" />
                        <x-form.error for="to" />
                    </div>
                </div>
            </template>

            <x-button variety="secondary" outline>Download Report</x-button>
        </form>

        <x-button.link
            href="{{ route('consignor.products.create') }}"
            wire:navigate
            variety="primary"
        >New Product</x-button.link>
    </div>

    <livewire:consignor.product.listing-table />

    <livewire:consignor.product.add-stock-form />
</x-consignor-layout>
