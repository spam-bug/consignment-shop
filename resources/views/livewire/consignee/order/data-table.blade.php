<div>
    <x-table>
        <x-slot:header>
            <x-table.heading>Reference Number</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Items Count</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Damage Items</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Total</x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Created On</x-table.heading>
            <x-table.heading></x-table.heading>
        </x-slot:header>

        <x-slot:body>
            @forelse ($orders as $order)
                <x-table.row>
                    <x-table.column class="font-medium">{{ strtoupper($order->reference_number) }}</x-table.column>

                    <x-table.column class="hidden lg:table-cell">{{ $order->items()->sum('quantity') }}</x-table.column>
                    <x-table.column class="hidden lg:table-cell">{{ $order->items()->sum('damage_quantity') }}</x-table.column>

                    <x-table.column class="hidden lg:table-cell">₱{{ number_format($order->total, 2) }}</x-table.column>

                    <x-table.column>
                        <x-status :variety="$order->status->variety()">{{ $order->status->value }}</x-status>
                    </x-table.column>

                    <x-table.column class="hidden lg:table-cell">{{ $order->created_at }}</x-table.column>

                    <x-table.column>
                        <x-dropdown>
                            <x-slot:trigger>
                                <i class="fa-solid fa-ellipsis"></i>
                            </x-slot:trigger>

                            <x-slot:menu>
                                <x-dropdown.button
                                    x-on:click="$dispatch('open-modal', { identifier: 'view-order', 'order': {{ $order }} })">View</x-dropdown.button>
                                    
                                @if ($order->status === \App\Enums\OrderStatus::Received && \Carbon\Carbon::parse($order->created_at)->lessThanOrEqualTo(now()))
                                    <x-dropdown.button
                                        x-on:click="$dispatch('open-modal', { identifier: 'report-damage', 'order': {{ $order }} })"
                                    >
                                        Report Damage
                                    </x-dropdown.button>
                                @endif

                                @if ($order->status === \App\Enums\OrderStatus::Shipped)
                                    <x-dropdown.button wire:click="received({{ $order }})">
                                        Receive Order
                                    </x-dropdown.button>
                                @endif

                                @if (!in_array($order->status, [\App\Enums\OrderStatus::Cancelled, \App\Enums\OrderStatus::Received]))
                                    <x-dropdown.button class="text-red-500" wire:click="cancel({{ $order }})">Cancel</x-dropdown.button>
                                @endif
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

    <x-table.pagination :data="$orders" />
</div>
