@props(['variety', 'outline' => false])

<button
    {{ $attributes->class([
        'inline-flex items-center justify-center gap-2 px-2 py-1.5 rounded border font-medium whitespace-nowrap',
        'border-rose-600 text-rose-600' => $outline && $variety === 'primary',
        'border-rose-600 bg-rose-600 text-white' => !$outline && $variety === 'primary',
        'border-gray-200 text-gray-700' => $outline && $variety === 'secondary',
        'border-gray-200 bg-gray-200 text-gray-700' => !$outline && $variety === 'secondary',
        'border-red-200 text-red-700' => $outline && $variety === 'danger',
        'border-red-200 bg-red-200 text-red-700' => !$outline && $variety === 'danger',
    ]) }}
>
    {{ $slot }}
</button>
