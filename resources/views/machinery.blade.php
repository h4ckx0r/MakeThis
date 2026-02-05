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
                        <h1 class="text-center text-5xl font-semibold sm:text-6xl lg:text-7xl">Maquinaria y Materiales</h1>
                    </div>
                </section>

                <section class="border-b border-base-300">
                    <div class="mx-auto max-w-7xl px-6 py-16">
                        <div class="grid gap-8">
                            @foreach (range(1, 3) as $index)
                                <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                                    <div class="flex flex-col lg:flex-row gap-8 items-start">

                                        {{-- Foto --}}
                                        <div class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 bg-base-100 flex items-center justify-center">
                                            <span class="text-3xl font-medium">Foto</span>
                                        </div>

                                        {{-- Texto --}}
                                        <p class="text-3xl leading-normal">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Phasellus viverra, lorem at malesuada porttitor, arcu sem pretium ipsum,
                                            vel egestas augue justo vitae nunc. Sed non nulla ut elit tincidunt aliquet.
                                            Curabitur pulvinar risus eu justo lacinia, nec gravida erat vehicula.
                                            Quisque in justo id turpis finibus tincidunt.
                                        </p>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </main>

            <x-home-footer />
        </div>
        @fluxScripts
    </body>
</html>
