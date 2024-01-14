<div class="py-4 sm:py-6 lg:py-8">
    <h3 class="sm:mx-p-6 mx-4 text-xl font-medium lg:mx-8">Damage Record</h3>

    <x-table class="mt-4">
        <x-slot:header>
            <x-table.heading>Date</x-table.heading>
            <x-table.heading>Quantity</x-table.heading>
            <x-table.heading>Remarks</x-table.heading>
        </x-slot:header>

        <x-slot:body>
            @forelse ($damages as $damage)
                <x-table.row>
                    <x-table.column>{{ $damage->created_at }}</x-table.column>
                    <x-table.column>{{ $damage->quantity }}</x-table.column>
                    <x-table.column>{{ $damage->remark }}</x-table.column>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.column colspan="3" class="text-center text-sm">No available data</x-table.column>
                </x-table.row>
            @endforelse
        </x-slot:body>
    </x-table>
</div>
