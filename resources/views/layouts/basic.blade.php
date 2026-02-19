<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:main class="p-0!">
            {{ $slot }}
        </flux:main>

        @livewireScripts
        @fluxScripts
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    </body>

</html>
