<x-auth-layout>
    <main class="flex flex-col items-center justify-center py-8">
        <x-application-logo />

        <div class="mt-8 w-full max-w-xl rounded bg-white p-4 shadow sm:p-6">
            <p class="text-xl font-medium">Hello, {{ ucfirst(auth()->user()->name) }}</p>

            <p class="mt-2">
                Our staff is currently reviewing your account registration.
                We will send you an email once your account has been approved!
            </p>

            <form
                action="{{ route('auth.logout') }}"
                method="POST"
                class="mt-4 flex justify-end"
            >
                @csrf
                <x-button variety="primary">Logout</x-button>
            </form>
        </div>

        <small class="mt-4 text-gray-500">© 2024 Consignment Shop. All rights reserved.</small>
    </main>
</x-auth-layout>
