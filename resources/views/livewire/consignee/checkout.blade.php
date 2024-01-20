<div class="grid w-full gap-8 p-4 sm:p-6 lg:grid-cols-3 lg:p-8">
    <div class="space-y-8 lg:col-span-2">
        <div>
            <p class="font-medium">REVIEW ORDER</p>

            <div class="mt-4 space-y-2">
                @foreach ($items as $item)
                    <div class="flex justify-between rounded border border-gray-200 p-4">
                        <div class="flex gap-2">
                            <div class="h-16 w-16 overflow-hidden rounded">
                                <img src="{{ asset($item->product->photos[0]) }}" alt="">
                            </div>

                            <div class="flex flex-col justify-between">
                                <p class="font-medium">{{ $item->product->name }}</p>

                                <div class="flex w-fit border border-gray-200">
                                    <button class="px-4 py-1 text-sm font-medium" wire:click="decrementQuantity({{ $item }})">-</button>
                                    <input
                                        type="text"
                                        value="{{ $item->quantity }}"
                                        min="1"
                                        class="block w-10 appearance-none border-x border-gray-200 text-center text-sm"
                                        readonly
                                    />
                                    <button class="px-4 py-1 text-sm font-medium" wire:click="incrementQuantity({{ $item }})">+</button>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-end justify-between">
                            <p class="font-medium text-rose-600">₱{{ number_format($item->total, 2) }}</p>

                            <button class="text-sm text-gray-500">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <p class="font-medium">DELIVERY ADDRESS</p>

            <div class="mt-4 space-y-4">
                <div>
                    <x-form.label for="contact_person">Contact Person</x-form.label>
                    <x-form.input type="text" wire:model="contact_person" />
                    <x-form.error for="contact_person" />
                </div>

                <div>
                    <x-form.label for="contact_number">Contact Number</x-form.label>
                    <x-form.input type="text" wire:model="contact_number" />
                    <x-form.error for="contact_number" />
                </div>

                <div>
                    <x-form.label for="street">Street</x-form.label>
                    <x-form.input type="text" wire:model="street" />
                    <x-form.error for="street" />
                </div>

                <div>
                    <x-form.label for="barangay">Barangay</x-form.label>
                    <x-form.input type="text" wire:model="barangay" />
                    <x-form.error for="barangay" />
                </div>

                <div>
                    <x-form.label for="city">City/Municipality</x-form.label>
                    <x-form.input type="text" wire:model="city" />
                    <x-form.error for="city" />
                </div>

                <div>
                    <x-form.label for="province">Province</x-form.label>
                    <x-form.input type="text" wire:model="province" />
                    <x-form.error for="province" />
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-8">
        <div class="rounded border border-gray-200 p-4">
            <p class="font-medium">SELECT PAYMENT METHOD</p>

            <label for="cod" class="mt-4 flex items-center gap-2 rounded border px-4 py-2">
                <input
                    id="cod"
                    type="radio"
                    wire:model="paymentMethod"
                >
                <p>Cash on Delivery</p>
            </label>
        </div>

        <div class="rounded border border-gray-200 p-4">
            <p class="font-medium">ORDER SUMMARY</p>

            <div class="mt-4 border-b border-dashed border-gray-200 pb-2">
                @foreach ($items as $item)
                    <div class="flex items-center justify-between gap-8">
                        <p>{{ $item->quantity }} x {{ $item->product->name }}</p>
                        <p>₱{{ number_format($item->total, 2) }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-2 flex items-center justify-between gap-8">
                <p class="text-xl font-bold">ORDER TOTAL</p>
                <p class="text-xl font-bold">₱{{ number_format($total, 2) }}</p>
            </div>
        </div>

        <x-button
            variety="primary"
            class="w-full"
            wire:click="completeOrder"
        >Complete Order</x-button>
    </div>
</div>
