@props(['src', 'alt' => '', 'size' => 'sm'])

<div
    {{ $attributes->class(['overflow-hidden rounded-full', 'h-8 w-8' => $size === 'sm', 'h-10 w-10' => $size === 'md', 'h-12 w-12' => $size === 'lg']) }}>
    <img src="{{ $src }}" alt="{{ $alt }}">
</div>
