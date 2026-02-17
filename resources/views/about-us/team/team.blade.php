<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="bg-base-100 text-base-content">
    <div class="min-h-screen">
        <livewire:navbar />

        <main>
            <!-- Cabecera con título -->
            <section class="border-b border-base-300">
                <div class="mx-auto max-w-7xl px-6 py-50">
                    <h1 class="text-center text-5xl font-semibold sm:text-6xl lg:text-7xl">Equipo</h1>
                </div>
            </section>

            <!-- Introducción al Equipo -->
            <section class="border-b border-base-300">
                <div class="mx-auto max-w-7xl px-6 py-16">
                    <div class="text-center max-w-4xl mx-auto mb-12">
                        <p class="text-2xl leading-relaxed">
                            Nuestro equipo está formado por profesionales apasionados por la impresión 3D y la
                            fabricación digital.
                            Combinamos experiencia técnica, creatividad y compromiso con la calidad para ofrecer el
                            mejor servicio a nuestros clientes.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Departamentos del Equipo -->
            <section class="border-b border-base-300">
                <div class="mx-auto max-w-7xl px-6 py-16">
                    <div class="grid gap-8">
                        {{-- Departamento de Diseño 3D --}}
                        <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                            <div class="flex flex-col lg:flex-row gap-8 items-start">
                                <img src="{{ asset('storage/equipo/diseno-3d.jpg') }}" alt="Equipo de Diseño 3D"
                                    class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                <div class="flex-1">
                                    <h2 class="text-4xl font-semibold mb-4">Departamento de Diseño 3D</h2>
                                    <p class="text-3xl leading-normal">
                                        Nuestros diseñadores 3D son expertos en modelado CAD y escultura digital.
                                        Dominan software
                                        profesional como Fusion 360, Blender, ZBrush y SolidWorks, transformando ideas
                                        en modelos
                                        optimizados para impresión. Se especializan en diseño paramétrico, ingeniería
                                        inversa y
                                        adaptación de modelos para garantizar la imprimibilidad y funcionalidad de cada
                                        pieza.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Departamento de Producción --}}
                        <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                            <div class="flex flex-col lg:flex-row gap-8 items-start">
                                <img src="{{ asset('storage/equipo/produccion.jpg') }}" alt="Equipo de Producción"
                                    class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                <div class="flex-1">
                                    <h2 class="text-4xl font-semibold mb-4">Departamento de Producción</h2>
                                    <p class="text-3xl leading-normal">
                                        Los técnicos de producción supervisan todo el proceso de fabricación, desde la
                                        configuración de
                                        los parámetros de impresión hasta el control de calidad final. Tienen amplia
                                        experiencia en el
                                        manejo de diferentes tecnologías (FDM, SLA, DLP) y materiales. Su conocimiento
                                        técnico garantiza
                                        que cada impresión cumpla con los estándares más exigentes de precisión y
                                        resistencia.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Departamento de Acabados --}}
                        <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                            <div class="flex flex-col lg:flex-row gap-8 items-start">
                                <img src="{{ asset('storage/equipo/acabados.jpg') }}" alt="Equipo de Acabados"
                                    class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                <div class="flex-1">
                                    <h2 class="text-4xl font-semibold mb-4">Departamento de Acabados y Post-Procesado
                                    </h2>
                                    <p class="text-3xl leading-normal">
                                        Nuestros especialistas en acabados son artesanos que transforman las piezas
                                        impresas en productos
                                        finales de calidad profesional. Expertos en técnicas de lijado, pulido, pintura,
                                        metalizado y
                                        ensamblaje, aplican tratamientos superficiales personalizados según las
                                        necesidades de cada proyecto.
                                        Su trabajo garantiza que cada pieza no solo funcione perfectamente, sino que
                                        también luzca impecable.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Departamento de Atención al Cliente --}}
                        <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                            <div class="flex flex-col lg:flex-row gap-8 items-start">
                                <img src="{{ asset('storage/equipo/atencion-cliente.jpg') }}"
                                    alt="Equipo de Atención al Cliente"
                                    class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                <div class="flex-1">
                                    <h2 class="text-4xl font-semibold mb-4">Departamento de Atención al Cliente</h2>
                                    <p class="text-3xl leading-normal">
                                        Nuestro equipo de atención al cliente combina conocimientos técnicos con
                                        excelentes habilidades
                                        de comunicación. Asesoran a los clientes en la elección de materiales, acabados
                                        y procesos más
                                        adecuados para cada proyecto. Gestionan los pedidos desde el primer contacto
                                        hasta la entrega final,
                                        asegurando una experiencia satisfactoria y manteniendo una comunicación clara en
                                        cada etapa.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <livewire:footer />
    </div>
    @fluxScripts
</body>

</html>