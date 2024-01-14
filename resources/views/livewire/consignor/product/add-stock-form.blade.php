<div>
    <x-modal.form
        :$identifier
        title="{{ $product->name ?? '' }}"
        wire:submit="save"
    >
        <x-slot:body>
            <div>
                <x-form.label for="quantity">Stock Quantity</x-form.label>
                <x-form.input
                    type="number"
                    wire:model="quantity"
                    min="1"
                    pattern="[0-9]"
                />
                <x-form.error for="quantity" />
            </div>

            <div class="mt-4">
                <x-form.label for="remark">Remark (optional)</x-form.label>
                <x-form.textarea wire:model="remark"></x-textarea>
                    <x-form.error for="remark" />
            </div>
        </x-slot:body>

        <x-slot:footer>
            <x-button
                x-on:click.prevent="$dispatch('close-modal')"
                variety="secondary"
                outline
            >
                Cancel
            </x-button>

            <x-button variety="primary">Submit</x-button>
        </x-slot:footer>
    </x-modal.form>
</div>
