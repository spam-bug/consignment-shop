<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

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

<body class="bg-gray-100 font-sans text-gray-700 antialiased">
    <header class="bg-white shadow">
        <x-container class="flex items-center justify-between">
            <div class="flex items-center gap-8">
                <x-application-logo href="{{ route('admin.dashboard') }}" />

                <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500">Dashboard</a>
                <a href="{{ route('admin.users') }}" class="text-sm text-gray-500">Users</a>
                <a href="#" class="text-sm text-gray-500">Products</a>
                <a href="{{ route('admin.categories') }}" class="text-sm text-gray-500">Category</a>
            </div>

            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button class="text-sm text-gray-500">Logout</button>
            </form>
        </x-container>
    </header>

    <main>
        <x-container class="sm:py-8">
            @if (session()->has('alert'))
                <x-alert :variety="session('alert')['type']->value">
                    {{ session('alert')['message'] }}
                </x-alert>
            @endif

            <div>
                {{ $slot }}
            </div>
        </x-container>
    </main>
    @livewireScripts
</body>

</html>
