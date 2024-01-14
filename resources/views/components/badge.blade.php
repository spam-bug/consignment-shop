@props(['variety'])

<span
    {{
        $attributes->class([
            'inline-block px-4 py-1 rounded-full uppercase text-xs font-medium tracking-wide',
            'bg-blue-50 text-blue-700' => $variety === 'info',
            'bg-green-50 text-green-700' => $variety === 'success',
            'bg-yellow-50 text-yellow-700' => $variety === 'warning',
            'bg-red-50 text-red-700' => $variety === 'danger',
        ])
    }}
>
    {{ $slot }}
</span>
