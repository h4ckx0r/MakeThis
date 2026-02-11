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
                    <div class="mx-auto max-w-7xl">
                        <div class="grid items-center">
                            <div class="scene">
                                <h1 class="text-center mt-10 -mb-10 text-5xl font-semibold sm:text-6xl lg:text-7xl" >MakeThis</h1>
                                @php
                                    $data = [ //Cambiar con imágenes de piezas 3d
                                        '1540968221243-29f5d70540bf',
                                        '1596135187959-562c650d98bc',
                                        '1628944682084-831f35256163',
                                        '1590013330451-3946e83e0392',
                                        '1590421959604-741d0eec0a2e',
                                        '1572613000712-eadc57acbecd',
                                        '1570097192570-4b49a6736f9f',
                                        '1620789550663-2b10e0080354',
                                        '1617775623669-20bff4ffaa5c',
                                        '1548600916-dc8492f8e845',
                                        '1573824969595-a76d4365a2e6',
                                        '1633936929709-59991b5fdd72',
                                    ];
                                    $n = count($data);
                                @endphp
                                <div class="a3d -mt-10" style="--n: {{ $n }}">
                                    @foreach($data as $i => $id)
                                        <img class="landing-card"
                                             src="https://images.unsplash.com/photo-{{ $id }}?w=280"
                                             style="--i: {{ $i }}"
                                             alt="Pieza impresa en 3d de muestra">
                                    @endforeach
                                </div>
                            </div>
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
