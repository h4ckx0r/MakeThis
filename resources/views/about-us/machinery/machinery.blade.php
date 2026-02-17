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
                    <h1 class="text-center text-5xl font-semibold sm:text-6xl lg:text-7xl">Maquinaria y Materiales</h1>
                </div>
            </section>

            <section class="border-b border-base-300">
                <div class="mx-auto max-w-7xl px-6 py-16">
                    <div class="grid gap-8">
                        {{-- Impresoras FDM --}}
                        <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                            <div class="flex flex-col lg:flex-row gap-8 items-start">
                                <img src="{{ asset('storage/machinery/impresora-fdm.jpg') }}" alt="Impresora FDM"
                                    class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                <div class="flex-1">
                                    <h2 class="text-4xl font-semibold mb-4">Impresoras FDM de Alta Precisión</h2>
                                    <p class="text-3xl leading-normal">
                                        Contamos con un parque de impresoras FDM (Modelado por Deposición Fundida) de
                                        última generación,
                                        capaces de trabajar con una amplia variedad de materiales termoplásticos como
                                        PLA, ABS, PETG, TPU
                                        y nylon. Nuestras máquinas ofrecen una precisión de capa de hasta 50 micrones,
                                        permitiéndonos
                                        fabricar desde prototipos funcionales hasta piezas finales de producción con
                                        acabados profesionales.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Impresoras de Resina --}}
                        <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                            <div class="flex flex-col lg:flex-row gap-8 items-start">
                                <img src="{{ asset('storage/machinery/impresora-resina.jpg') }}"
                                    alt="Impresora de Resina"
                                    class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                <div class="flex-1">
                                    <h2 class="text-4xl font-semibold mb-4">Tecnología SLA/DLP - Resina Fotopolimérica
                                    </h2>
                                    <p class="text-3xl leading-normal">
                                        Nuestras impresoras de resina utilizan tecnología SLA y DLP para conseguir
                                        detalles ultra-finos
                                        y superficies excepcionalmente suaves. Son ideales para joyería, odontología,
                                        miniaturas y
                                        prototipos de alta precisión. Trabajamos con resinas estándar, flexibles,
                                        resistentes a altas
                                        temperaturas y biocompatibles, alcanzando resoluciones de hasta 25 micrones.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Materiales y Post-Procesado --}}
                        <div class="rounded-lg border border-base-300 bg-base-200 p-6">
                            <div class="flex flex-col lg:flex-row gap-8 items-start">
                                <img src="{{ asset('storage/machinery/materiales.jpg') }}"
                                    alt="Materiales y Post-Procesado"
                                    class="h-[468px] w-full lg:w-[336px] flex-shrink-0 rounded-lg border border-base-300 object-cover">
                                <div class="flex-1">
                                    <h2 class="text-4xl font-semibold mb-4">Estación de Post-Procesado y Acabados</h2>
                                    <p class="text-3xl leading-normal">
                                        Disponemos de equipamiento especializado para el post-procesado de piezas:
                                        cámaras de curado UV
                                        para resinas, baños de limpieza por ultrasonidos, lijadoras de precisión,
                                        aerógrafos profesionales
                                        y cabina de pintura. Esto nos permite ofrecer acabados personalizados que
                                        incluyen lijado,
                                        pintado, metalizado y recubrimientos protectores, elevando la calidad final de
                                        cada pieza.
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