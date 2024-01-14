<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans text-gray-700 antialiased">
    <header class="bg-white shadow">
        <x-container class="flex items-center justify-between">
            <x-application-logo href="{{ route('home') }}" />

            <div class="flex items-center gap-4">
                <x-button.link href="{{ route('auth.login') }}" variety="primary">Login</x-button.link>
                <a href="{{ route('auth.register') }}">Register</a>
            </div>
        </x-container>
    </header>

    <main>
        <x-container>
            {{ $slot }}
        </x-container>
    </main>

    @livewireScripts
</body>

</html>
