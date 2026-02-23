<x-layouts::home :title="'Inicio'">
    <main class="pt-10">
        <section class="border-b border-base-300">
            <div class="mx-auto max-w-7xl">
                <div class="grid items-center">
                    <div class="scene">
                        <h1 class="text-center mt-10 -mb-10 text-5xl font-semibold sm:text-6xl lg:text-7xl">MakeThis
                        </h1>
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
                                style="--i: {{ $i }}" alt="Pieza impresa en 3d de muestra">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="border-b border-base-300">
            <div class="mx-auto max-w-7xl px-6 py-10">
                <div class="flex justify-center">
                    <span class="text-2xl font-bold italic px-2 tracking-widest">LOS MEJORES EN:</span>
                </div>
            </div>
        </section>

        <section class="border-b border-base-300">
            <div class="mx-auto max-w-7xl px-6 py-10">
                <div class="flex flex-wrap justify-center gap-6 sm:gap-10">

                    <span class="text-rotate text-3xl duration-4000">
                        <span class="justify-items-center">
                            <span>MODELADO</span>
                            <span class="font-bold italic px-2">DISEÑO 3D</span>
                        </span>
                    </span>
                    <span class="text-rotate text-3xl duration-6000">
                        <span class="justify-items-center">
                            <span>ESCANEADO</span>
                            <span class="font-bold italic px-2">FRESADO</span>
                        </span>
                    </span>
                    <span class="text-rotate text-3xl duration-4500">
                        <span class="justify-items-center">
                            <span>ATENCIÓN</span>
                            <span class="font-bold italic px-2">SERVICIO</span>
                        </span>
                    </span>
                    <span class="text-rotate text-3xl duration-65000">
                        <span class="justify-items-center">
                            <span>DETALLE</span>
                            <span class="font-bold italic px-2">CALIDAD</span>
                        </span>
                    </span>

                </div>
            </div>
        </section>

        <section class="border-b border-base-300">
            <div class="mx-auto max-w-7xl px-6 py-12">
                <div class="flex justify-center">
                    <ul class="timeline timeline-snap-icon max-md:timeline-compact timeline-vertical">

                        <li>
                            <div class="timeline-middle">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="timeline-start mb-10 md:text-end">
                                <time class="font-mono italic">2019</time>
                                <div class="text-lg font-black">Nacimiento de MakeThis</div>
                                MakeThis nace como un estudio creativo especializado en diseño y fabricación digital,
                                con el
                                objetivo de transformar ideas en objetos reales mediante tecnología 3D. Desde el inicio,
                                la
                                empresa apuesta por la innovación, la precisión y la personalización de cada proyecto.
                            </div>
                            <hr />
                        </li>

                        <li>
                            <hr />
                            <div class="timeline-middle">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="timeline-end md:mb-10">
                                <time class="font-mono italic">2020</time>
                                <div class="text-lg font-black">Escaneado y modelado 3D</div>
                                Se incorporan servicios avanzados de escaneado 3D y modelado digital, permitiendo la
                                reproducción exacta de piezas existentes y el desarrollo de nuevos diseños optimizados
                                para
                                fabricación, restauración o mejora funcional.
                            </div>
                            <hr />
                        </li>

                        <li>
                            <hr />
                            <div class="timeline-middle">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="timeline-start mb-10 md:text-end">
                                <time class="font-mono italic">2021</time>
                                <div class="text-lg font-black">Fabricación de piezas a medida</div>
                                MakeThis amplía su actividad a la creación de piezas 3D personalizadas, tanto para
                                prototipado
                                como para producción final, colaborando con empresas, diseñadores y particulares en
                                proyectos
                                técnicos y creativos.
                            </div>
                            <hr />
                        </li>

                        <li>
                            <hr />
                            <div class="timeline-middle">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="timeline-end md:mb-10">
                                <time class="font-mono italic">2022</time>
                                <div class="text-lg font-black">Fresado y mecanizado CNC</div>
                                Se integran procesos de fresado y mecanizado CNC, permitiendo trabajar con distintos
                                materiales
                                y alcanzar altos niveles de precisión en la fabricación de componentes técnicos y
                                estructurales.
                            </div>
                            <hr />
                        </li>

                        <li>
                            <hr />
                            <div class="timeline-middle">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="timeline-start mb-10 md:text-end">
                                <time class="font-mono italic">Hoy</time>
                                <div class="text-lg font-black">Innovación continua</div>
                                Actualmente, MakeThis combina diseño, ingeniería y fabricación digital para ofrecer
                                soluciones
                                completas, adaptadas a cada cliente, apostando por la creatividad, la calidad y la
                                mejora
                                constante de sus procesos.
                            </div>
                        </li>

                    </ul>
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