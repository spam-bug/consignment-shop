<div class="flex gap-4">
    <div class="flex gap-2">
        <x-avatar src="{{ $consignor->user->photo() }}" />
        <p class="font-medium">{{ $consignor->user->username }}</p>
    </div>

    <x-button
        variety="secondary"
        outline
        wire:click="message"
    >Message</x-button>
</div>
