<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:main class="p-0!">
        {{ $slot }}
    </flux:main>

    @fluxScripts
</body>

</html>
