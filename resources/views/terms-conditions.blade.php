<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="bg-base-100 text-base-content">
    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        <livewire:navbar />

        {{-- Sección de título --}}
        <section class="border-b border-base-300">
            <div class="mx-auto max-w-7xl px-6 py-12">
                <h1 class="text-center text-[48px] font-normal">
                    Términos y Condiciones
                </h1>
            </div>
        </section>

        {{-- Contenido principal --}}
        <main class="flex-1 border-b border-base-300">
            <div class="mx-auto max-w-6xl px-6 py-12">
                <p class="text-[32px] font-normal text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus viverra, lorem at malesuada
                    porttitor, arcu sem pretium ipsum, vel egestas augue justo vitae nunc. Sed non nulla ut elit
                    tincidunt aliquet. Curabitur pulvinar risus eu justo lacinia, nec gravida erat vehicula. Quisque in
                    justo id turpis finibus tincidunt. Integer cursus, justo vitae luctus lacinia, felis nisl cursus
                    risus, a porttitor metus. Donec ultrices velit sed purus dapibus tincidunt.
                </p>
            </div>
        </main>

        {{-- Footer --}}
        <livewire:footer />
    </div>
    @fluxScripts
</body>

</html>