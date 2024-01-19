<div>
    <x-table>
        <x-slot:header>
            <x-table.heading>Consignor</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Contract</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Signed by you</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Signed by consignor</x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading class="hidden lg:table-cell">Created On</x-table.heading>
            <x-table.heading></x-table.heading>
        </x-slot:header>

        <x-slot:body>
            @forelse ($contracts as $contract)
                <x-table.row>
                    <x-table.column>{{ $contract->consignor->user->username }}</x-table.column>
                    <x-table.column>
                        <a wire:click="download('{{ $contract->generated_contract }}')" class="text-blue-500 hover:underline">
                            @php
                                $generated_contract = explode('/', $contract->generated_contract);

                                echo end($generated_contract);
                            @endphp
                        </a>
                    </x-table.column>

                    <x-table.column class="hidden lg:table-cell">
                        <a wire:click="download('{{ $contract->uploaded_consignee_contract }}')" class="text-blue-500 hover:underline">
                            @php
                                $uploaded_consignee_contract = explode('/', $contract->uploaded_consignee_contract);

                                echo end($uploaded_consignee_contract);
                            @endphp
                        </a>
                    </x-table.column>

                    <x-table.column class="hidden lg:table-cell">
                        <a wire:click="download('{{ $contract->uploaded_consignor_contract }}')" class="text-blue-500 hover:underline">
                            @php
                                $uploaded_consignor_contract = explode('/', $contract->uploaded_consignor_contract);

                                echo end($uploaded_consignor_contract);
                            @endphp
                        </a>
                    </x-table.column>
                    <x-table.column>
                        <x-status :variety="$contract->status->variety()">{{ $contract->status->value }}</x-status>
                    </x-table.column>

                    <x-table.column class="hidden lg:table-cell">{{ $contract->created_at }}</x-table.column>

                    <x-table.column>
                        <x-dropdown>
                            <x-slot:trigger>
                                <i class="fa-solid fa-ellipsis"></i>
                            </x-slot:trigger>

                            <x-slot:menu>
                                @if ($contract->status === \App\Enums\ContractStatus::Pending)
                                    <x-dropdown.button
                                        x-on:click="$dispatch('open-modal', { identifier: 'contract-uploader', 'contract': {{ $contract }} })"
                                    >
                                        Upload
                                    </x-dropdown.button>
                                @endif
                                <x-dropdown.link>Cancel</x-dropdown.link>
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

    <x-table.pagination :data="$contracts" />
</div>
