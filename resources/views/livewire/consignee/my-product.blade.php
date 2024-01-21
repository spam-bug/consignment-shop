<div>
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="flex items-center justify-between">
            <form action="{{ route('consignee.reports.product') }}" method="POST">
                @csrf
                <x-button variety="secondary" outline>Download Report</x-button>
            </form>
        </div>
    </div>

    <x-table>
        <x-slot:header>
            <x-table.heading>Product Name</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Category</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Unit Price</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Quantity</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Total</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Consignor</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Created On</x-table.heading>
        </x-slot:header>

        <x-slot:body>
            @forelse ($products as $product)
                <x-table.row>

                    <x-table.column class="font-medium">{{ $product->info->name }}</x-table.column>

                    <x-table.column class="hidden lg:table-cell">{{ $product->info->category->name }}</x-table.column>

                    <x-table.column class="hidden lg:table-cell">{{ $product->info->unit_price }}</x-table.column>
                    <x-table.column class="hidden lg:table-cell">{{ $product->stock }}</x-table.column>
                    <x-table.column class="hidden lg:table-cell">₱{{ number_format($product->total, 2) }}</x-table.column>

                    <x-table.column class="hidden lg:table-cell">{{ $product->info->consignor->user->username }}</x-table.column>
                    <x-table.column class="hidden lg:table-cell">{{ $product->created_at }}</x-table.column>
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
