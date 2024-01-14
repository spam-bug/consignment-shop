@props(['identifier', 'title'])

<x-modal :$identifier :$title>
    <form wire:submit="{{ $attributes->whereStartsWith('wire:submit')->first() }}">
        <div class="border-b border-gray-200 p-4">
            {{ $body }}
        </div>

        <div class="flex justify-end gap-2 p-4">
            {{ $footer }}
        </div>
    </form>
</x-modal>
