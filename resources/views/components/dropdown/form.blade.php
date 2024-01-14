@props(['action', 'method'])

<form action="{{ $action }}" method="{{ $method }}">
    @csrf

    @if ($method !== 'POST' || $method !== 'post')
        @method($method)
    @endif

    <button
        {{ $attributes->class(['inline-flex items-center gap-2 pl-4 pr-16 py-1.5 whitespace-nowrap hover:bg-gray-100 w-full']) }}>{{ $slot }}</button>
</form>
