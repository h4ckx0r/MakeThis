<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <script type="module" src="https://unpkg.com/@splinetool/viewer@1.12.52/build/spline-viewer.js"></script>
    </head>
    <body class="bg-base-100 text-base-content">
        <div class="min-h-screen">
            <x-home-navbar />

            <main>
                <section class="border-b border-base-300">
                    <div class="mx-auto max-w-7xl px-6 py-16">
                        <div class="grid items-center gap-10 lg:grid-cols-[1.2fr,1fr]">
                            <div>
                                <h1 class="text-5xl font-semibold sm:text-6xl lg:text-7xl">MakeThis</h1>
                            </div>
                            <spline-viewer url="https://prod.spline.design/2L2wYelnD5nqJvEF/scene.splinecode"></spline-viewer>
                        </div>
                    </div>
                </section>

                <section class="border-b border-base-300">
                    <div class="mx-auto max-w-7xl px-6 py-10">
                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach (range(1, 4) as $index)
                                <div class="card border border-base-300 bg-base-200 shadow-none">
                                    <div class="card-body items-center justify-center">
                                        <h2 class="text-2xl font-medium">Servicios</h2>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section class="border-b border-base-300">
                    <div class="mx-auto max-w-7xl px-6 py-12">
                        <div class="grid gap-8 lg:grid-cols-2">
                            @foreach (range(1, 4) as $index)
                                <div class="card border border-base-300 bg-base-200 shadow-none">
                                    <div class="card-body items-center justify-center py-16">
                                        <h2 class="text-2xl font-medium">Noticia Blog</h2>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section class="border-b border-base-300">
                    <div class="mx-auto max-w-7xl px-6 py-12">
                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach (range(1, 12) as $index)
                                <div class="card border border-base-300 bg-base-200 shadow-none">
                                    <div class="card-body items-center justify-center py-8">
                                        <h2 class="text-xl font-medium">Producto</h2>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-10 flex justify-center">
                            <div class="join">
                                <button class="btn btn-xs join-item btn-outline" type="button">‹</button>
                                <button class="btn btn-xs join-item btn-active" type="button">•</button>
                                <button class="btn btn-xs join-item btn-outline" type="button">•</button>
                                <button class="btn btn-xs join-item btn-outline" type="button">•</button>
                                <button class="btn btn-xs join-item btn-outline" type="button">•</button>
                                <button class="btn btn-xs join-item btn-outline" type="button">•</button>
                                <button class="btn btn-xs join-item btn-outline" type="button">›</button>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <x-home-footer />
        </div>
        @fluxScripts
    </body>
</html>
