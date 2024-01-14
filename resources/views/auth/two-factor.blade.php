<x-auth-layout>
    <main class="flex flex-col items-center justify-center py-8">
        <x-application-logo />

        <form
            method="POST"
            action="{{ route('auth.two-factor.verify') }}"
            class="mt-8 w-full max-w-xl rounded bg-white p-4 shadow sm:p-6"
        >
            @csrf

            <h1 class="text-xl font-medium">Two Factor Authentication</h1>

            <div class="mt-4">
                <x-form.label for="code">Enter verification code</x-form.label>
                <x-form.input
                    id="code"
                    type="code"
                    name="code"
                />
                <x-form.error for="code" />
            </div>

            <div class="mt-4 flex justify-end">
                <x-button variety="primary">Verify</x-button>
            </div>
        </form>

        <small class="mt-4 text-gray-500">© 2024 Consignment Shop. All rights reserved.</small>
    </main>
</x-auth-layout>
