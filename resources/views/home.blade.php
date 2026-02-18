<x-layouts::home :title="'Inicio'">
            <main class="pt-10">
                <section class="border-b border-base-300">
                    <div class="mx-auto max-w-7xl">
                        <div class="grid items-center">
                            <div class="scene">
                                <h1 class="text-center mt-10 -mb-10 text-5xl font-semibold sm:text-6xl lg:text-7xl" >MakeThis</h1>
                                @php
                                    $data = [
                                        '30640195',
                                        '30415869',
                                        '30620861',
                                        '9242916',
                                        '35595049',
                                        '33800640',
                                        '17509941',
                                        '14158951',
                                        '3861437',
                                        '19278850',
                                        '31137405',
                                        '7869233',
                                    ];
                                    $n = count($data);
                                @endphp
                                <div class="a3d -mt-10" style="--n: {{ $n }}">
                                    @foreach($data as $i => $id)
                                        <img class="landing-card"
                                             src="https://images.pexels.com/photos/{{ $id }}/pexels-photo-{{ $id }}.jpeg?auto=compress&cs=tinysrgb&h=350"
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
</x-layouts::home>
