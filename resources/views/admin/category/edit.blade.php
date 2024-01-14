<x-admin-layout>
    <div class="flex items-center gap-4">

        <h1 class="text-3xl font-medium">Edit {{ $category->name }}</h1>
    </div>

    <form
        method="POST"
        action="{{ route('admin.categories.update', $category) }}"
        class="mt-8 rounded bg-white p-4 shadow sm:p-6 lg:p-8"
    >
        @csrf
        @method('PATCH')

        <div>
            <x-form.label for="name">Name</x-form.label>
            <x-form.input
                type="text"
                name="name"
                value="{{ $category->name }}"
            />
            <x-form.error for="name" />
        </div>

        <div class="mt-4 flex gap-2">
            <x-button.link href="{{ route('admin.categories') }}" variety="secondary">Cancel</x-button.link>
            <x-button variety="primary">Update</x-button>
        </div>
    </form>
</x-admin-layout>
