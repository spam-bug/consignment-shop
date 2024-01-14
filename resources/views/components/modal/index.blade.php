@props(['identifier', 'title' => ''])

<template x-teleport="body">
    <div
        class="fixed inset-0 z-50 h-screen w-full"
        x-data="{ open: false, identifier: @js($identifier) }"
        x-on:open-modal.window="open = identifier === event.detail || identifier === event.detail.identifier"
        x-on:close-modal.window="open = false"
        x-on:keydown.esc.window="open = false"
        x-show="open"
        x-cloak
        x-transition:enter="transition-all ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-32"
        x-transition:enter-end="opacity-100 translate-y-0"
        tabindex="-1"
    >
        <div class="pointer-events-none absolute inset-0"></div>

        <div
            class="absolute left-1/2 top-1/2 mx-auto w-full max-w-2xl -translate-x-1/2 -translate-y-1/2 rounded border border-gray-200 bg-white shadow">
            <div class="flex items-center justify-between gap-8 border-b border-gray-200 p-4">
                <h3 class="line-clamp-1 text-xl font-medium">{{ $title }}</h3>

                <button x-on:click="$dispatch('close-modal')"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</template>
