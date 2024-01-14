<div class="py-4 sm:py-6 lg:py-8">
    <h3 class="sm:mx-p-6 mx-4 text-xl font-medium lg:mx-8">Stock Record</h3>

    <x-table class="mt-4">
        <x-slot:header>
            <x-table.heading>Date</x-table.heading>
            <x-table.heading>Quantity</x-table.heading>
            <x-table.heading>Remarks</x-table.heading>
        </x-slot:header>

        <x-slot:body>
            @foreach ($stocks as $stock)
                <x-table.row>
                    <x-table.column>{{ $stock->created_at }}</x-table.column>
                    <x-table.column>{{ $stock->quantity }}</x-table.column>
                    <x-table.column>{{ $stock->remark }}</x-table.column>
                </x-table.row>
            @endforeach
        </x-slot:body>
    </x-table>
</div>
