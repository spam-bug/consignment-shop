@props(['data'])

@if ($data->hasMorePages())
    <div class="p-4">
        {{ $data->links('vendor.pagination.tailwind') }}
    </div>
@endif
