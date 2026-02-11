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
                        <h1 class="text-center text-5xl font-semibold sm:text-6xl lg:text-7xl">Colaboraciones</h1>
                    </div>
                </section>

                <!-- Introducción a Colaboraciones -->
                <section class="border-b border-base-300">
                    <div class="mx-auto max-w-7xl px-6 py-16">
                        <div class="text-center max-w-4xl mx-auto mb-12">
                            <p class="text-2xl leading-relaxed">
                                Colaboramos con empresas e instituciones líderes en sus sectores para desarrollar proyectos innovadores
                                que impulsan el uso de la fabricación aditiva en la industria, la investigación y la educación.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Colaboraciones -->
                <section class="border-b border-base-300">
                    <div class="mx-auto max-w-7xl px-6 py-16">
                        <div class="grid gap-8">
                            {{-- Universidad Politécnica de Madrid --}}
                            <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                                <div class="flex flex-col lg:flex-row gap-8 items-start">
                                    <img src="{{ asset('storage/colaboraciones/upm.jpg') }}"
                                         alt="Universidad Politécnica de Madrid"
                                         class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                    <div class="flex-1">
                                        <h2 class="text-4xl font-semibold mb-4">Universidad Politécnica de Madrid (UPM)</h2>
                                        <p class="text-3xl leading-normal">
                                            Colaboramos con la UPM en proyectos de investigación sobre nuevos materiales y aplicaciones
                                            de impresión 3D en ingeniería. Fabricamos prototipos para sus laboratorios de I+D y apoyamos
                                            programas educativos proporcionando piezas didácticas para sus estudiantes. Esta alianza nos
                                            mantiene a la vanguardia de las últimas innovaciones en fabricación aditiva.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- CSIC --}}
                            <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                                <div class="flex flex-col lg:flex-row gap-8 items-start">
                                    <img src="{{ asset('storage/colaboraciones/csic.jpg') }}"
                                         alt="CSIC - Consejo Superior de Investigaciones Científicas"
                                         class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                    <div class="flex-1">
                                        <h2 class="text-4xl font-semibold mb-4">CSIC - Consejo Superior de Investigaciones Científicas</h2>
                                        <p class="text-3xl leading-normal">
                                            Trabajamos con diferentes institutos del CSIC fabricando componentes personalizados para
                                            equipamiento científico y experimentos. Nuestra capacidad de producir piezas complejas con
                                            geometrías imposibles de lograr con métodos tradicionales ha sido clave en proyectos de
                                            física aplicada, biotecnología y ciencias de materiales.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Airbus --}}
                            <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                                <div class="flex flex-col lg:flex-row gap-8 items-start">
                                    <img src="{{ asset('storage/colaboraciones/airbus.jpg') }}"
                                         alt="Airbus"
                                         class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                    <div class="flex-1">
                                        <h2 class="text-4xl font-semibold mb-4">Airbus</h2>
                                        <p class="text-3xl leading-normal">
                                            Colaboramos con Airbus en la fabricación de prototipos funcionales y herramientas de
                                            utillaje para sus líneas de producción. La impresión 3D permite reducir tiempos y costes
                                            en el desarrollo de componentes aeronáuticos no estructurales. Trabajamos con materiales
                                            certificados que cumplen con los estrictos estándares de la industria aeroespacial.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEAT --}}
                            <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                                <div class="flex flex-col lg:flex-row gap-8 items-start">
                                    <img src="{{ asset('storage/colaboraciones/seat.jpg') }}"
                                         alt="SEAT"
                                         class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                    <div class="flex-1">
                                        <h2 class="text-4xl font-semibold mb-4">SEAT</h2>
                                        <p class="text-3xl leading-normal">
                                            Apoyamos a SEAT en la creación de piezas auxiliares, herramientas de montaje y prototipos
                                            para el desarrollo de nuevos modelos. La fabricación aditiva acelera significativamente
                                            los ciclos de diseño en la industria automotriz, permitiendo iteraciones rápidas antes
                                            de la producción en serie. Nuestro trabajo contribuye a la innovación en sus procesos.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Hospital La Paz --}}
                            <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                                <div class="flex flex-col lg:flex-row gap-8 items-start">
                                    <img src="{{ asset('storage/colaboraciones/hospital-la-paz.jpg') }}"
                                         alt="Hospital Universitario La Paz"
                                         class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                    <div class="flex-1">
                                        <h2 class="text-4xl font-semibold mb-4">Hospital Universitario La Paz</h2>
                                        <p class="text-3xl leading-normal">
                                            Colaboramos con el Hospital La Paz fabricando modelos anatómicos personalizados a partir
                                            de TACs y resonancias para planificación quirúrgica. Estos modelos 3D ayudan a los cirujanos
                                            a preparar intervenciones complejas con mayor precisión. También producimos guías quirúrgicas
                                            y prótesis personalizadas que mejoran los resultados clínicos y la recuperación de los pacientes.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Fundación Española para la Ciencia y la Tecnología (FECYT) --}}
                            <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                                <div class="flex flex-col lg:flex-row gap-8 items-start">
                                    <img src="{{ asset('storage/colaboraciones/fecyt.jpg') }}"
                                         alt="FECYT"
                                         class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                    <div class="flex-1">
                                        <h2 class="text-4xl font-semibold mb-4">Fundación Española para la Ciencia y la Tecnología (FECYT)</h2>
                                        <p class="text-3xl leading-normal">
                                            Participamos en proyectos de divulgación científica con FECYT, creando piezas educativas
                                            y maquetas interactivas para museos y exposiciones. Nuestro trabajo ayuda a acercar la
                                            tecnología de fabricación aditiva al público general, especialmente a estudiantes y jóvenes,
                                            inspirando vocaciones científicas y tecnológicas en las nuevas generaciones.
                                        </p>
                                    </div>
                                </div>
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
