<div
    x-data="{ open: false }"
    x-on:keypress.esc.window="open = false"
    class="relative w-fit"
>
    <div x-on:click="open = !open">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        x-on:click.outside="open = false"
        x-cloak
        class="absolute right-0 z-50 mt-1 overflow-hidden rounded border border-gray-200 bg-white shadow"
    >
        {{ $menu }}
    </div>
</div>
