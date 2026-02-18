<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-base-100 text-base-content pt-16">
<div class="flex! flex-col">
    <livewire:navbar/>
    <flux:main class="p-0!">
        {{ $slot }}
    </flux:main>
    <livewire:footer />
</div>
@livewireScripts
@fluxScripts

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
