<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="bg-base-100 text-base-content">
    <div class="min-h-screen">
        <livewire:navbar />

        <main>
            <section class="border-b border-base-300">
                <div class="mx-auto max-w-7xl px-6 py-50">
                    <h1 class="text-center text-5xl font-semibold sm:text-6xl lg:text-7xl">Sobre Nosotros</h1>
                </div>
            </section>

            <section class="border-b border-base-300">
                <div class="mx-auto max-w-7xl px-6 py-16">
                    <div class="grid gap-8 lg:grid-cols-3">
                        <a href="{{ route('about-us.machinery') }}" wire:navigate
                            class="btn btn-xl h-auto w-full bg-base-100 shadow-none py-16 border-0">

                            <div class="hover-3d">
                                <!-- content -->
                                <figure class="max-w-100 rounded-2xl">
                                    <h2 class="text-3xl font-medium">
                                        Maquinaria
                                    </h2>
                                    <img src="{{ asset('images/about-us/images.jpeg') }}" alt="3D card" class="rounded-t-2xl" />

                                </figure>
                                <!-- 8 empty divs needed for the 3D effect -->
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>

                        </a>
                        <a href="{{ route('about-us.team') }}" wire:navigate
                            class="btn btn-xl h-auto w-full bg-base-100 shadow-none py-16 border-0">
                            <div class="hover-3d">
                                <!-- content -->
                                <figure class="max-w-100 rounded-2xl">
                                    <h2 class="text-3xl font-medium">
                                        Equipo
                                    </h2>
                                    <img src="{{ asset('images/about-us/unnamed.jpg') }}" alt="3D card" class="rounded-t-2xl" />
                                </figure>
                                <!-- 8 empty divs needed for the 3D effect -->
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </a>
                        <a href="{{ route('about-us.collaborations') }}" wire:navigate
                            class="btn btn-xl h-auto w-full bg-base-100 shadow-none py-16 border">
                            <div class="hover-3d">
                                <!-- content -->
                                <figure class="max-w-100 rounded-2xl">
                                    <img src="{{ asset('images/about-us/colaboraciones.webp') }}" alt="3D card" class="rounded-t-2xl" />
                                    <h2 class="text-3xl font-medium">
                                        Colaboraciones</h2>
                                </figure>
                                <!-- 8 empty divs needed for the 3D effect -->
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </a>

                    </div>
                </div>
            </section>
        </main>

        <livewire:footer />
    </div>
    @fluxScripts
</body>

</html>
