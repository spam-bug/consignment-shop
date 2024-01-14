<x-admin-layout>
    <div class="flex items-center gap-4">

        <h1 class="text-3xl font-medium">New Category</h1>
    </div>

    <form
        method="POST"
        action="{{ route('admin.categories.store') }}"
        class="mt-8 rounded bg-white p-4 shadow sm:p-6 lg:p-8"
    >
        @csrf

        <div>
            <x-form.label for="name">Name</x-form.label>
            <x-form.input type="text" name="name" />
            <x-form.error for="name" />
        </div>

        <div class="mt-4 flex gap-2">
            <x-button.link href="{{ route('admin.categories') }}" variety="secondary">Cancel</x-button.link>
            <x-button variety="primary">Create</x-button>
        </div>
    </form>
</x-admin-layout>
