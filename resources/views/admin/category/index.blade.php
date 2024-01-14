@php use Carbon\Carbon; @endphp
<x-admin-layout>
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-medium">Category</h1>

        <x-button.link href="{{ route('admin.categories.create') }}" variety="primary">New</x-button.link>
    </div>

    <div class="mt-8 rounded bg-white shadow">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-2 text-left text-sm font-medium uppercase">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium uppercase">Created On</th>
                    <th class="px-4 py-2 text-right text-sm font-medium uppercase"><i class="fa-solid fa-ellipsis"></i></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @if ($categories->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No available data.</td>
                    </tr>
                @else
                    @foreach ($categories as $category)
                        <tr>
                            <td class="p-4 text-left font-medium capitalize">{{ $category->name }}</td>
                            <td class="p-4 text-left">{{ Carbon::parse($category->created_at)->format('F d, Y') }}</td>
                            <td class="p-4">
                                <div class="flex justify-end gap-2">
                                    <x-button.link href="{{ route('admin.categories.edit', $category) }}" variety="secondary">edit</x-button.link>
                                    <form action="{{ route('admin.categories.delete', $category) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-button variety="secondary">delete</x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        @if ($categories->hasMorePages())
            <div class="border-t border-gray-200 p-4">
                {{ $categories->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</x-admin-layout>
