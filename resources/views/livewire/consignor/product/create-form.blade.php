@php use App\Enums\ProductCategory; @endphp
<div>
    <form wire:submit="save">
        <div class="border-b border-gray-200 p-4 sm:p-6 lg:p-8">
            <h4 class="text-xl font-medium">Basic Information</h4>

            <div class="mt-4">
                <x-form.label for="category">Category</x-form.label>
                <x-form.select id="category" wire:model="form.category">
                    <option selected disabled>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                    @endforeach
                </x-form.select>
                <x-form.error for="form.category" />
            </div>

            <div class="mt-4">
                <x-form.label for="name">Name</x-form.label>
                <x-form.input
                    id="name"
                    type="text"
                    wire:model="form.name"
                />
                <x-form.error for="form.name" />
            </div>

            <div class="mt-4">
                <x-form.label for="description">Description</x-form.label>
                <x-form.textarea id="description" wire:model="form.description" />
                <x-form.error for="form.description" />
            </div>

            <div class="mt-4">
                <p>Photos</p>

                <div class="flex flex-wrap gap-4">
                    @for ($index = 0; $index < 5; $index++)
                        <div>
                            @if (isset($form->photos[$index]) && $form->photos[$index])
                                <div class="group relative h-32 w-32 overflow-hidden rounded">
                                    <img
                                        src="{{ $form->photos[$index]->temporaryUrl() }}"
                                        alt=""
                                        class="h-full w-full object-cover object-center"
                                    >

                                    <div
                                        class="absolute inset-0 flex h-full w-full items-center justify-center bg-black/50 opacity-0 transition-opacity duration-300 ease-in-out group-hover:opacity-100">
                                        <button class="text-white" wire:click.prevent="removePhoto({{ $index }})">Remove</button>
                                    </div>
                                </div>
                            @else
                                <label for="photos_{{ $index }}"
                                    class="flex h-32 w-32 cursor-pointer items-center justify-center rounded border border-gray-200"
                                >
                                    <input
                                        id="photos_{{ $index }}"
                                        type="file"
                                        class="hidden"
                                        wire:model="form.photos.{{ $index }}"
                                        accept="image/jpeg,image/png"
                                    />

                                    <i class="fa-regular fa-image text-3xl text-gray-300"></i>
                                </label>
                            @endif
                            <x-form.error for="form.photos.{{ $index }}" />
                        </div>
                    @endfor
                </div>

                <x-form.error for="form.photos" />
            </div>
        </div>

        <div class="p-4 sm:p-6 lg:p-8">
            <div class="flex items-center justify-between">
                <h4 class="text-xl font-medium">Sales Information</h4>
            </div>

            <div class="mt-4">
                <x-form.label for="sku">Stock Keeping Unit (SKU)</x-form.label>
                <x-form.input
                    id="sku"
                    type="text"
                    wire:model="form.sku"
                />
                <x-form.error for="form.sku" />
            </div>

            <div class="mt-4">
                <x-form.label for="price">Original Price</x-form.label>
                <div class="relative">
                    <x-form.input
                        id="price"
                        type="text"
                        wire:model.blur="form.price"
                        class="pl-10"
                    />
                    <p class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">₱</p>
                </div>
                <x-form.error for="form.price" />
            </div>

            <div class="mt-4">
                <x-form.label for="selling_price">Selling Price</x-form.label>
                <div class="relative">
                    <x-form.input
                        id="selling_price"
                        type="text"
                        wire:model.blur="form.selling_price"
                        class="pl-10"
                    />
                    <p class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">₱</p>
                </div>
                <x-form.error for="form.selling_price" />
            </div>

            <div class="mt-4">
                <x-form.label for="stocks">Stocks</x-form.label>
                <x-form.input
                    id="stocks"
                    type="text"
                    wire:model="form.stock"
                    oninput="window.formatter.numbers_only(event)"
                />
                <x-form.error for="form.initial_stock" />
            </div>

            <div class="mt-4">
                <x-form.label for="stock_threshold">Stock Threshold</x-form.label>
                <x-form.input
                    id="stock_threshold"
                    type="text"
                    wire:model="form.stock_threshold"
                    oninput="window.formatter.numbers_only(event)"
                />
                <x-form.error for="form.stock_threshold" />
                @if (!$errors->has('form.stock_threshold'))
                    <small class="text-gray-500">This field is used to determine if the stock is low.</small>
                @endif
            </div>
        </div>

        <div class="lg:-8 p-4 sm:p-6">
            <x-button.link href="{{ route('consignor.products') }}" variety="secondary">Cancel</x-button.link>
            <x-button variety="primary">Save</x-button>
        </div>
    </form>
</div>
