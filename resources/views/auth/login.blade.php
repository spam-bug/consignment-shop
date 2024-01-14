<x-auth-layout>
    <header class="flex justify-end p-4 sm:px-6">
        <p>Don't have an account yet? <a href="{{ route('auth.register') }}" class="text-blue-500 hover:underline">Register</a></p>
    </header>

    <main class="flex flex-col items-center justify-center py-8">
        <x-application-logo />

        <form
            class="mt-8 w-full max-w-xl rounded bg-white p-4 shadow sm:p-6"
            enctype="multipart/form-data"
            method="POST"
            action="/login"
        >
            @csrf

            <h2 class="text-2xl font-semibold">Welcome Back</h2>

            <div class="mt-4">
                <x-form.label for="email">Email</x-form.label>
                <x-form.input
                    id="email"
                    type="email"
                    name="email"
                />
                <x-form.error for="email" />
            </div>

            <div class="mt-4">
                <x-form.label for="password">Password</x-form.label>
                <div class="relative" x-data="{ show: false }">
                    <x-form.input
                        id="password"
                        x-bind:type="show ? 'text' : 'password'"
                        name="password"
                        class="pr-10"
                    />

                    <button
                        x-on:click.prevent="show = !show"
                        class="absolute right-4 top-1/2 -translate-y-1/2"
                        tabindex="-1"
                    >
                        <i class="fa-solid fa-eye" x-show="!show"></i>
                        <i class="fa-solid fa-eye-slash" x-show="show"></i>
                    </button>
                </div>
                <x-form.error for="password" />
            </div>

            <x-button variety="primary" class="mt-4 w-full">Login</x-button>
        </form>

        <small class="mt-4 text-gray-500">© 2024 Consignment Shop. All rights reserved.</small>
    </main>
</x-auth-layout>
