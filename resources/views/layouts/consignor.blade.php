<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ is_callable($title) ? $title() : $title }} | {{ config('app.name') }}</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="font-sans text-gray-700 antialiased"
    x-data="{ shown: window.innerWidth > 996 }"
    x-on:resize.window="shown = window.innerWidth > 996"
>
    <div class="fixed inset-y-0 left-0 z-50 h-screen w-64 -translate-x-full border-r border-gray-200 bg-white transition-transform duration-300 ease-in-out lg:translate-x-0"
        x-bind:class="shown ? 'translate-x-0' : ''"
    >
        <div class="border-b border-gray-200 p-4">
            <x-application-logo />
        </div>

        <div class="mx-4 mt-4 flex items-center justify-between rounded border border-gray-200 p-4">
            <div class="flex items-center gap-2">
                <x-avatar src="{{ auth()->user()->photo() }}" />
                <p>{{ ucfirst(auth()->user()->name) }}</p>
            </div>

            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf

                <button title="Log Out">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>

        <div class="mt-8 px-4">
            <p class="text-sm font-medium">MENU</p>

            <ul>
                <li>
                    <a
                        href="{{ route('consignor.products') }}"
                        wire:navigate
                        class="flex items-center gap-2 rounded px-4 py-2 hover:bg-gray-100"
                    >
                        <i class="fa-regular fa-star"></i>
                        <p>Products</p>
                    </a>
                </li>

                <li>
                    <a
                        href="{{ route('consignor.contracts') }}"
                        wire:navigate
                        class="flex items-center gap-2 rounded px-4 py-2 hover:bg-gray-100"
                    >
                        <i class="fa-regular fa-file"></i>
                        <p>Contracts</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="lg:ml-64">
        <header class="sticky inset-0 z-40 flex h-[65px] items-center justify-between border-b border-gray-200 bg-white p-4">
            <h1 class="text-2xl font-medium">{{ is_callable($title) ? $title() : $title }}</h1>

            <x-button
                variety="secondary"
                outline
                x-on:click="shown = !shown"
                class="lg:hidden"
            >
                <i class="fa-solid fa-bars"></i>
            </x-button>
        </header>

        <main>
            <x-alert />

            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>

</html>
