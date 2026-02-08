<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-base-100 text-base-content">
        <div class="min-h-screen">
            <x-home-navbar />

            <main>
                <!-- Cabecera con título -->
                <section class="border-b border-base-300">
                    <div class="mx-auto max-w-7xl px-6 py-16">
                        <h1 class="text-center text-5xl font-semibold sm:text-6xl lg:text-7xl">Equipo</h1>
                    </div>
                </section>

                <!-- Sección para contenido futuro -->
                <section class="border-b border-base-300">
                    <div class="mx-auto max-w-7xl px-6 py-16">
                        <div class="text-center text-lg text-base-content/60">
                            <p>Contenido próximamente</p>
                        </div>
                    </div>
                </section>
            </main>

            <x-home-footer />
        </div>
        @fluxScripts
    </body>
</html>
