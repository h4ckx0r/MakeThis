<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-base-100 text-base-content">
        <div class="min-h-screen">
            <x-home-navbar />

            <main>
                <section class="border-b border-base-300">
                    <div class="mx-auto max-w-7xl px-6 py-16">
                        <h1 class="text-center text-5xl font-semibold sm:text-6xl lg:text-7xl">Sobre Nosotros</h1>
                    </div>
                </section>

                <section class="border-b border-base-300">
                    <div class="mx-auto max-w-7xl px-6 py-16">
                        <div class="grid gap-8 lg:grid-cols-3">
                            <a href="{{ route('about-us.machinery') }}" wire:navigate class="btn btn-xl h-auto w-full border border-base-300 bg-base-200 shadow-none py-16">
                                <h2 class="text-3xl font-medium">Maquinaria y Materiales</h2>
                            </a>
                            <a href="{{ route('about-us.team') }}" wire:navigate class="btn btn-xl h-auto w-full border border-base-300 bg-base-200 shadow-none py-16">
                                <h2 class="text-3xl font-medium">Equipo</h2>
                            </a>
                            <a href="{{ route('about-us.collaborations') }}" wire:navigate class="btn btn-xl h-auto w-full border border-base-300 bg-base-200 shadow-none py-16">
                                <h2 class="text-3xl font-medium">Colaboraciones</h2>
                            </a>
                        </div>
                    </div>
                </section>
            </main>

            <x-home-footer />
        </div>
        @fluxScripts
    </body>
</html>
