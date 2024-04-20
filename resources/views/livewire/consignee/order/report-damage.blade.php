<div>
    <x-modal :$identifier title="Report Damage Product">
        @if (!is_null($order))
            <div class="p-4">
                <div class="space-y-2">
                    <div class="flex items-center justify-between gap-8">
                        <p>Reference Number</p>
                        <p class="font-semibold">{{ strtoupper($order->reference_number) }}</p>
                    </div>
                    
                    <div class="flex items-center justify-between gap-8">
                        <p>Order Status</p>
                        <x-status :variety="$order->status->variety()">{{ $order->status->value }}</x-status>
                    </div>

                    <div class="flex items-center justify-between gap-8">
                        <p>Order Date</p>
                        <p>{{ $order->created_at }}</p>
                    </div>

                    <div class="flex items-center justify-between gap-8">
                        <p>Consignor</p>
                        <p>{{ $order->consignor->user->username }}</p>
                    </div>
                </div>

                <form wire:submit="submit" class="mt-4">
                    <p class="font-medium">DAMAGED ITEMS</p>

                    <div class="mt-4 space-y-2">
                        @if ($order->items->count() > 1)
                            <div class="flex justify-end">
                                <x-button variety="secondary" outline wire:click="addItem">Add Item</x-button>
                            </div>
                        @endif

                        <div>                     
                            <p>Proof of Damage (atleast 1)</p>
                            <div class="relative flex gap-2">
                                @if ($order->is_damage_reported)
                                    @foreach ($medias as $media)
                                        <img src="{{ asset($media) }}" alt="" class="inline-block w-24 h-24 rounded">
                                    @endforeach
                                @else
                                    @for ($index = 0; $index < 5; $index++)
                                        @if (isset($medias[$index]) && $medias[$index] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                                            <div class="relative inline-block w-24 h-24 rounded overflow-hidden group">
                                                <div class="opacity-0 w-24 h-24 absolute inset-0 bg-black/25 flex items-center justify-center transition-opacity duration-300 ease-in-out group-hover:opacity-100">
                                                    <button class="text-white" wire:click.prevent="removeMedia({{ $index }})">Remove</button>
                                                </div>
                                                
                                                <img src="{{ $medias[$index]->temporaryUrl() }}" alt="" class="inline-block w-24 h-24 rounded">
                                            </div>
                                        @else
                                            <label for="media-{{ $index }}" class=" w-24 h-24 rounded border-2 border-dashed border-gray-200 inline-flex items-center justify-center">
                                                <div wire:loading wire:target="medias.{{ $index }}" class="w-4 h-4 rounded-full border-2 border-r-transparent border-gray-300 animate-spin"></div>
                                                <i wire:loading.remove wire:target="medias.{{ $index }}" class="fa-regular fa-image text-2xl text-gray-300"></i>
                                                <input type="file" id="media-{{ $index }}" wire:model.live="medias.{{ $index }}" accept="image/jpeg" class="sr-only">
                                            </label>
                                        @endif
                                    @endfor

                                    <x-form.error for="medias" />
                                @endif
                            </div>
                        </div>

                        @foreach ($items as $index => $item)
                            <div>
                                <div class="flex gap-2">
                                    <div class="w-full">
                                        <x-form.label for="item">Item</x-form.label>

                                        <x-form.select wire:model="items.{{ $index }}.id" id="item" >
                                            <option value="">Select Product</option>
                                            @foreach ($order->items as $orderedItem)
                                                <option value="{{ $orderedItem->id }}">{{ $orderedItem->product->name }}</option>
                                            @endforeach
                                        </x-form.select>
                                    </div>

                                    <div class="w-full">
                                        <x-form.label for="quantity">Quantity</x-form.label>
                                        <x-form.input type="number" id="quantity" wire:model="items.{{ $index }}.quantity"/>
                                    </div>

                                    @if (count($items) > 1) 
                                        <x-button variety="danger" wire:click="removeItem({{ $index }})">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </x-button>
                                    @endif
                                </div>
                                <x-form.error for="items.{{ $index }}.id" />
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 flex justify-end gap-2">
                        @if($order->is_damage_reported)
                            <x-button variety="secondary" outline wire:click.prevent="cancel">Close</x-button>
                        @else
                            <x-button variety="secondary" outline wire:click.prevent="cancel">Cancel</x-button>
                            <x-button variety="primary">Report</x-button>
                        @endif
                    </div>
                </form>
            </div>
        @endif
    </x-modal>
</div>
