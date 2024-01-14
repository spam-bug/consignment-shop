@props(['variety' => 'light'])

<div>
    <span @class([
        'inline-block h-2 w-2 rounded-full',
        'bg-blue-500' => $variety === 'info',
        'bg-green-500' => $variety === 'success',
        'bg-red-500' => $variety === 'danger',
        'bg-yellow-500' => $variety === 'warning',
        'bg-gray-200' => $variety === 'light',
    ])></span>

    <p @class([
        'ml-1 inline-block text-sm',
        'text-blue-500' => $variety === 'info',
        'text-green-500' => $variety === 'success',
        'text-red-500' => $variety === 'danger',
        'text-yellow-500' => $variety === 'warning',
        'text-gray-500' => $variety === 'light',
    ])>
        {{ $slot }}
    </p>
</div>
