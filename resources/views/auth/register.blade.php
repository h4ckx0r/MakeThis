<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="bg-base-100 text-base-content">
    <livewire:auth.register />
    <x-turnstile.scripts />
    @fluxScripts
</body>

</html>
