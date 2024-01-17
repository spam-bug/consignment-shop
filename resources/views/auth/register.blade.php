<x-auth-layout>
    <header class="flex justify-end p-4 sm:px-6">
        <p>Already have an account? <a href="{{ route('auth.login') }}" class="text-blue-500 hover:underline">Log in</a></p>
    </header>

    <main class="flex flex-col items-center justify-center py-8">
        <x-application-logo />

        <form
            class="mt-8 w-full max-w-xl rounded bg-white p-4 shadow sm:p-6"
            enctype="multipart/form-data"
            method="POST"
            action="/register"
        >
            @csrf

            <h2 class="text-2xl font-semibold">Create an account</h2>

            <div class="mt-8 flex justify-center gap-4">
                <label for="consignee">
                    <input
                        id="consignee"
                        class="peer hidden"
                        type="radio"
                        name="type"
                        value="consignee"
                        checked
                    >

                    <div class="flex flex-col items-center rounded border border-gray-200 pb-4 peer-checked:border peer-checked:border-rose-600">
                        <img
                            src="{{ Vite::image('consignee.png') }}"
                            alt="Consignee"
                            class="w-40"
                        />
                        <p class="font-medium">Consignee</p>
                    </div>
                </label>

                <label for="consignor">
                    <input
                        id="consignor"
                        class="peer hidden"
                        type="radio"
                        name="type"
                        value="consignor"
                    >
                    <div class="flex flex-col items-center rounded border border-gray-200 pb-4 peer-checked:border peer-checked:border-rose-600">
                        <img
                            src="{{ Vite::image('consignor.png') }}"
                            alt="consignor"
                            class="w-40"
                        />
                        <p class="font-medium">Consignor</p>
                    </div>
                </label>
            </div>

            <div class="mt-4">
                <x-form.label for="name">Name</x-form.label>
                <x-form.input
                    id="name"
                    type="text"
                    name="name"
                />
                <x-form.error for="name" />
            </div>

            <div class="mt-4">
                <x-form.label for="username">Username</x-form.label>
                <x-form.input
                    id="username"
                    type="text"
                    name="username"
                />
                <x-form.error for="username" />
            </div>

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

            <div class="mt-4">
                <x-form.label for="business_name">Business Name</x-form.label>
                <x-form.input
                    id="business_name"
                    type="text"
                    name="business_name"
                />
                <x-form.error for="business_name" />
            </div>

            <div class="mt-4">
                <x-form.label for="business_permit">Business Permit</x-form.label>
                <input
                    type="file"
                    class="block w-full rounded border pr-4 file:appearance-none file:border-none file:bg-gray-100 file:px-4 file:py-2"
                    name="business_permit"
                />
                <x-form.error for="business_permit" />
            </div>

            <x-button variety="primary" class="mt-4 w-full">Register</x-button>
        </form>

        <small class="mt-4 text-gray-500">© 2024 Consignment Shop. All rights reserved.</small>
    </main>
</x-auth-layout>
