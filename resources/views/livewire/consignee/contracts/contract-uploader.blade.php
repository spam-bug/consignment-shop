<div>
    <x-modal.form
        :$identifier
        title="Upload Signed Contract"
        wire:submit="save"
    >
        <x-slot:body>
            <div>
                <x-form.label for="signedContract">Signed Contract</x-form.label>
                <input
                    type="file"
                    class="block w-full rounded border pr-4 file:appearance-none file:border-none file:bg-gray-100 file:px-4 file:py-2"
                    wire:model="signedContract"
                    accept="application/pdf"
                />
                <x-form.error for="signedContract" />
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
