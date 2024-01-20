<div>
    <x-table>
        <x-slot:header>
            <x-table.heading>Reference Number</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Order Reference number</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Number of Items</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Total</x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Created On</x-table.heading>
            <x-table.heading></x-table.heading>
        </x-slot:header>

        <x-slot:body>
            @forelse ($transactions as $transaction)
                <x-table.row>
                    <x-table.column class="font-medium">{{ strtoupper($transaction->reference_number) }}</x-table.column>

                    <x-table.column class="hidden font-medium lg:table-cell">{{ strtoupper($transaction->order->reference_number) }}</x-table.column>
                    <x-table.column class="hidden lg:table-cell">{{ $transaction->order->items()->sum('quantity') }}</x-table.column>

                    <x-table.column class="hidden lg:table-cell">₱{{ number_format($transaction->total, 2) }}</x-table.column>

                    <x-table.column>
                        <x-status :variety="$transaction->status->variety()">{{ $transaction->status->value }}</x-status>
                    </x-table.column>

                    <x-table.column class="hidden lg:table-cell">{{ $transaction->created_at }}</x-table.column>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.column colspan="9" class="text-center text-sm">No data available</x-table.column>
                </x-table.row>
            @endforelse
        </x-slot:body>
    </x-table>

    <x-table.pagination :data="$transactions" />
</div>
