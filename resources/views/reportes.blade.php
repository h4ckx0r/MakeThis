@php
$title = 'Reportes';
@endphp

<x-layouts::basic :title="$title">
    <div class="flex h-full w-full flex-1 flex-col">
        {{-- Header Section --}}
        <div class="border-b border-neutral-200 bg-neutral-50 px-10 py-5 dark:border-neutral-700 dark:bg-neutral-800">
            <div class="mx-auto flex max-w-7xl items-center justify-between">
                {{-- Profile Section --}}
                <div class="flex items-center gap-5">
                    <div
                        class="flex h-28 w-28 items-center justify-center rounded-full bg-neutral-400 text-center text-xs text-black">
                        Foto de<br>Perfil
                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="text-base font-medium">@Nombre</span>
                        <button
                            class="w-fit rounded border border-neutral-900 bg-white px-4 py-1 text-xl dark:border-neutral-100 dark:bg-neutral-900">⋯</button>
                    </div>
                </div>

                {{-- Header Navigation --}}
                <nav class="flex gap-2">
                    <button
                        class="rounded-full border border-neutral-900 bg-white px-5 py-2 text-sm transition hover:bg-neutral-100 dark:border-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800">Prioridades</button>
                    <button
                        class="rounded-full border border-neutral-900 bg-white px-5 py-2 text-sm transition hover:bg-neutral-100 dark:border-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800">Proximidad</button>
                    <button
                        class="rounded-full border border-neutral-900 bg-white px-5 py-2 text-sm transition hover:bg-neutral-100 dark:border-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800">Popularidad</button>
                    <button
                        class="rounded-full border border-neutral-900 bg-white px-5 py-2 text-sm transition hover:bg-neutral-100 dark:border-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800">Mi
                        Cuenta</button>
                </nav>
            </div>
        </div>

        {{-- Tab Navigation --}}
        <nav class="flex border-b border-neutral-900 dark:border-neutral-100">
            <a href="{{ route('reportes') }}"
                class="flex-1 max-w-[200px] border-r border-neutral-900 bg-white px-8 py-3 text-sm font-semibold text-center dark:border-neutral-100 dark:bg-neutral-900">Reportes</a>
            <a href="{{ route('solicitudes') }}"
                class="flex-1 max-w-[200px] border-r border-neutral-900 bg-neutral-100 px-8 py-3 text-sm transition hover:bg-neutral-200 text-center dark:border-neutral-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">Solicitudes</a>
            <button
                class="flex-1 max-w-[200px] border-r border-neutral-900 bg-neutral-100 px-8 py-3 text-sm transition hover:bg-neutral-200 dark:border-neutral-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">Mensajes</button>
            <a href="{{ route('usuarios') }}"
                class="flex-1 max-w-[200px] border-r border-neutral-900 bg-neutral-100 px-8 py-3 text-sm transition hover:bg-neutral-200 text-center dark:border-neutral-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">Usuarios</a>
            <button
                class="flex-1 max-w-[200px] border-neutral-900 bg-neutral-100 px-8 py-3 text-sm transition hover:bg-neutral-200 dark:border-neutral-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">Catálogo</button>
        </nav>

        {{-- Main Content --}}
        <div class="flex-1 px-10 py-8">
            <div class="mx-auto max-w-7xl">
                {{-- Page Title --}}
                <h1 class="mb-5 text-2xl font-semibold">Reportes de Rafa</h1>

                {{-- Search and Filter --}}
                <div class="mb-5 flex items-center gap-4">
                    <div
                        class="flex flex-1 max-w-md items-center gap-3 rounded border border-neutral-900 bg-white px-4 py-2 dark:border-neutral-100 dark:bg-neutral-900">
                        <span class="text-base">🔍</span>
                        <input type="text" placeholder="Buscar Nº Solicitud"
                            class="flex-1 border-none bg-transparent text-sm outline-none">
                    </div>
                    <button
                        class="flex items-center gap-2 rounded border border-neutral-900 bg-white px-4 py-2 text-sm dark:border-neutral-100 dark:bg-neutral-900">
                        <span>Filtrar</span>
                        <span class="text-lg">☰</span>
                    </button>
                </div>

                {{-- Reports List --}}
                <div class="mb-8 flex flex-col gap-2">
                    {{-- Report Item 1 - Yellow --}}
                    <details class="collapse bg-base-100 border border-base-300" name="my-accordion-det-1" open>
                        <summary class="collapse-title font-semibold">Nº Solicitud - Fecha - Estado</summary>
                        <div class="collapse-content text-sm">
                            <div
                                class="flex items-start gap-4 rounded border border-neutral-900 bg-neutral-100 p-4 dark:border-neutral-100 dark:bg-neutral-800">
                                <input type="checkbox"
                                    class="mt-0.5 h-5 w-5 flex-shrink-0 appearance-none rounded border-2 border-neutral-900 bg-yellow-400 dark:border-neutral-100">
                                <div class="flex-1">
                                    <div class="mb-4 flex items-center justify-between">
                                        <span class="text-sm">Nº Solicitud - Fecha - Estado</span>
                                        <button class="px-2 text-xl">∧</button>
                                    </div>

                                    {{-- Expanded Content --}}
                                    <div class="space-y-4">
                                        {{-- Meta Information --}}
                                        <div class="space-y-2">
                                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                                <span class="font-medium">Nº Solicitud:</span>
                                                <span
                                                    class="border-b border-neutral-900 px-2 dark:border-neutral-100">_______</span>
                                                <span class="font-medium">Cliente</span>
                                                <span class="font-medium">Tipo: Fallo en la entrega</span>
                                            </div>
                                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                                <span class="font-medium">Fecha:</span>
                                                <div class="flex gap-1">
                                                    <input type="text" value="DD"
                                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                    <input type="text" value="MM"
                                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                    <input type="text" value="AAAA"
                                                        class="w-14 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                </div>
                                                <span class="font-medium">Estado</span>
                                            </div>
                                        </div>

                                        {{-- Content Grid --}}
                                        <div class="grid gap-5 md:grid-cols-2">
                                            {{-- Files Box --}}
                                            <div
                                                class="min-h-[150px] rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                                <div class="flex h-full items-center justify-between">
                                                    <span class="cursor-pointer text-2xl text-neutral-600">‹</span>
                                                    <div class="text-center text-sm leading-relaxed">
                                                        <p>Archivos adjuntos, fotos,</p>
                                                        <p>informes, firmas electrónicas.</p>
                                                    </div>
                                                    <span class="cursor-pointer text-2xl text-neutral-600">›</span>
                                                </div>
                                            </div>

                                            {{-- Details Box --}}
                                            <div
                                                class="min-h-[150px] overflow-y-auto rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                                <p class="text-sm">Información detallada del tipo</p>
                                                <p class="text-sm">de reporte</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </details>
                    <details class="collapse bg-base-100 border border-base-300" name="my-accordion-det-1" open>
                        <summary class="collapse-title font-semibold">Nº Solicitud - Fecha - Estado</summary>
                        <div class="collapse-content text-sm">
                            <div
                                class="flex items-start gap-4 rounded border border-neutral-900 bg-neutral-100 p-4 dark:border-neutral-100 dark:bg-neutral-800">
                                <input type="checkbox"
                                    class="mt-0.5 h-5 w-5 flex-shrink-0 appearance-none rounded border-2 border-neutral-900 bg-yellow-400 dark:border-neutral-100">
                                <div class="flex-1">
                                    <div class="mb-4 flex items-center justify-between">
                                        <span class="text-sm">Nº Solicitud - Fecha - Estado</span>
                                        <button class="px-2 text-xl">∧</button>
                                    </div>

                                    {{-- Expanded Content --}}
                                    <div class="space-y-4">
                                        {{-- Meta Information --}}
                                        <div class="space-y-2">
                                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                                <span class="font-medium">Nº Solicitud:</span>
                                                <span
                                                    class="border-b border-neutral-900 px-2 dark:border-neutral-100">_______</span>
                                                <span class="font-medium">Cliente</span>
                                                <span class="font-medium">Tipo: Fallo en la entrega</span>
                                            </div>
                                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                                <span class="font-medium">Fecha:</span>
                                                <div class="flex gap-1">
                                                    <input type="text" value="DD"
                                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                    <input type="text" value="MM"
                                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                    <input type="text" value="AAAA"
                                                        class="w-14 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                </div>
                                                <span class="font-medium">Estado</span>
                                            </div>
                                        </div>

                                        {{-- Content Grid --}}
                                        <div class="grid gap-5 md:grid-cols-2">
                                            {{-- Files Box --}}
                                            <div
                                                class="min-h-[150px] rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                                <div class="flex h-full items-center justify-between">
                                                    <span class="cursor-pointer text-2xl text-neutral-600">‹</span>
                                                    <div class="text-center text-sm leading-relaxed">
                                                        <p>Archivos adjuntos, fotos,</p>
                                                        <p>informes, firmas electrónicas.</p>
                                                    </div>
                                                    <span class="cursor-pointer text-2xl text-neutral-600">›</span>
                                                </div>
                                            </div>

                                            {{-- Details Box --}}
                                            <div
                                                class="min-h-[150px] overflow-y-auto rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                                <p class="text-sm">Información detallada del tipo</p>
                                                <p class="text-sm">de reporte</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </details>
                    <details class="collapse bg-base-100 border border-base-300" name="my-accordion-det-1" open>
                        <summary class="collapse-title font-semibold">Nº Solicitud - Fecha - Estado</summary>
                        <div class="collapse-content text-sm">
                            <div
                                class="flex items-start gap-4 rounded border border-neutral-900 bg-neutral-100 p-4 dark:border-neutral-100 dark:bg-neutral-800">
                                <input type="checkbox"
                                    class="mt-0.5 h-5 w-5 flex-shrink-0 appearance-none rounded border-2 border-neutral-900 bg-yellow-400 dark:border-neutral-100">
                                <div class="flex-1">
                                    <div class="mb-4 flex items-center justify-between">
                                        <span class="text-sm">Nº Solicitud - Fecha - Estado</span>
                                        <button class="px-2 text-xl">∧</button>
                                    </div>

                                    {{-- Expanded Content --}}
                                    <div class="space-y-4">
                                        {{-- Meta Information --}}
                                        <div class="space-y-2">
                                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                                <span class="font-medium">Nº Solicitud:</span>
                                                <span
                                                    class="border-b border-neutral-900 px-2 dark:border-neutral-100">_______</span>
                                                <span class="font-medium">Cliente</span>
                                                <span class="font-medium">Tipo: Fallo en la entrega</span>
                                            </div>
                                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                                <span class="font-medium">Fecha:</span>
                                                <div class="flex gap-1">
                                                    <input type="text" value="DD"
                                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                    <input type="text" value="MM"
                                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                    <input type="text" value="AAAA"
                                                        class="w-14 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                </div>
                                                <span class="font-medium">Estado</span>
                                            </div>
                                        </div>

                                        {{-- Content Grid --}}
                                        <div class="grid gap-5 md:grid-cols-2">
                                            {{-- Files Box --}}
                                            <div
                                                class="min-h-[150px] rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                                <div class="flex h-full items-center justify-between">
                                                    <span class="cursor-pointer text-2xl text-neutral-600">‹</span>
                                                    <div class="text-center text-sm leading-relaxed">
                                                        <p>Archivos adjuntos, fotos,</p>
                                                        <p>informes, firmas electrónicas.</p>
                                                    </div>
                                                    <span class="cursor-pointer text-2xl text-neutral-600">›</span>
                                                </div>
                                            </div>

                                            {{-- Details Box --}}
                                            <div
                                                class="min-h-[150px] overflow-y-auto rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                                <p class="text-sm">Información detallada del tipo</p>
                                                <p class="text-sm">de reporte</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </details>
                    <details class="collapse bg-base-100 border border-base-300" name="my-accordion-det-1" open>
                        <summary class="collapse-title font-semibold">Nº Solicitud - Fecha - Estado</summary>
                        <div class="collapse-content text-sm">
                            <div
                                class="flex items-start gap-4 rounded border border-neutral-900 bg-neutral-100 p-4 dark:border-neutral-100 dark:bg-neutral-800">
                                <input type="checkbox"
                                    class="mt-0.5 h-5 w-5 flex-shrink-0 appearance-none rounded border-2 border-neutral-900 bg-yellow-400 dark:border-neutral-100">
                                <div class="flex-1">
                                    <div class="mb-4 flex items-center justify-between">
                                        <span class="text-sm">Nº Solicitud - Fecha - Estado</span>
                                        <button class="px-2 text-xl">∧</button>
                                    </div>

                                    {{-- Expanded Content --}}
                                    <div class="space-y-4">
                                        {{-- Meta Information --}}
                                        <div class="space-y-2">
                                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                                <span class="font-medium">Nº Solicitud:</span>
                                                <span
                                                    class="border-b border-neutral-900 px-2 dark:border-neutral-100">_______</span>
                                                <span class="font-medium">Cliente</span>
                                                <span class="font-medium">Tipo: Fallo en la entrega</span>
                                            </div>
                                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                                <span class="font-medium">Fecha:</span>
                                                <div class="flex gap-1">
                                                    <input type="text" value="DD"
                                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                    <input type="text" value="MM"
                                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                    <input type="text" value="AAAA"
                                                        class="w-14 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                </div>
                                                <span class="font-medium">Estado</span>
                                            </div>
                                        </div>

                                        {{-- Content Grid --}}
                                        <div class="grid gap-5 md:grid-cols-2">
                                            {{-- Files Box --}}
                                            <div
                                                class="min-h-[150px] rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                                <div class="flex h-full items-center justify-between">
                                                    <span class="cursor-pointer text-2xl text-neutral-600">‹</span>
                                                    <div class="text-center text-sm leading-relaxed">
                                                        <p>Archivos adjuntos, fotos,</p>
                                                        <p>informes, firmas electrónicas.</p>
                                                    </div>
                                                    <span class="cursor-pointer text-2xl text-neutral-600">›</span>
                                                </div>
                                            </div>

                                            {{-- Details Box --}}
                                            <div
                                                class="min-h-[150px] overflow-y-auto rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                                <p class="text-sm">Información detallada del tipo</p>
                                                <p class="text-sm">de reporte</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </details>
                    <details class="collapse bg-base-100 border border-base-300" name="my-accordion-det-1" open>
                        <summary class="collapse-title font-semibold">Nº Solicitud - Fecha - Estado</summary>
                        <div class="collapse-content text-sm">
                            <div
                                class="flex items-start gap-4 rounded border border-neutral-900 bg-neutral-100 p-4 dark:border-neutral-100 dark:bg-neutral-800">
                                <input type="checkbox"
                                    class="mt-0.5 h-5 w-5 flex-shrink-0 appearance-none rounded border-2 border-neutral-900 bg-yellow-400 dark:border-neutral-100">
                                <div class="flex-1">
                                    <div class="mb-4 flex items-center justify-between">
                                        <span class="text-sm">Nº Solicitud - Fecha - Estado</span>
                                        <button class="px-2 text-xl">∧</button>
                                    </div>

                                    {{-- Expanded Content --}}
                                    <div class="space-y-4">
                                        {{-- Meta Information --}}
                                        <div class="space-y-2">
                                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                                <span class="font-medium">Nº Solicitud:</span>
                                                <span
                                                    class="border-b border-neutral-900 px-2 dark:border-neutral-100">_______</span>
                                                <span class="font-medium">Cliente</span>
                                                <span class="font-medium">Tipo: Fallo en la entrega</span>
                                            </div>
                                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                                <span class="font-medium">Fecha:</span>
                                                <div class="flex gap-1">
                                                    <input type="text" value="DD"
                                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                    <input type="text" value="MM"
                                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                    <input type="text" value="AAAA"
                                                        class="w-14 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                </div>
                                                <span class="font-medium">Estado</span>
                                            </div>
                                        </div>

                                        {{-- Content Grid --}}
                                        <div class="grid gap-5 md:grid-cols-2">
                                            {{-- Files Box --}}
                                            <div
                                                class="min-h-[150px] rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                                <div class="flex h-full items-center justify-between">
                                                    <span class="cursor-pointer text-2xl text-neutral-600">‹</span>
                                                    <div class="text-center text-sm leading-relaxed">
                                                        <p>Archivos adjuntos, fotos,</p>
                                                        <p>informes, firmas electrónicas.</p>
                                                    </div>
                                                    <span class="cursor-pointer text-2xl text-neutral-600">›</span>
                                                </div>
                                            </div>

                                            {{-- Details Box --}}
                                            <div
                                                class="min-h-[150px] overflow-y-auto rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                                <p class="text-sm">Información detallada del tipo</p>
                                                <p class="text-sm">de reporte</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </details>
                    <details class="collapse bg-base-100 border border-base-300" name="my-accordion-det-1" open>
                        <summary class="collapse-title font-semibold">Nº Solicitud - Fecha - Estado</summary>
                        <div class="collapse-content text-sm">
                            <div
                                class="flex items-start gap-4 rounded border border-neutral-900 bg-neutral-100 p-4 dark:border-neutral-100 dark:bg-neutral-800">
                                <input type="checkbox"
                                    class="mt-0.5 h-5 w-5 flex-shrink-0 appearance-none rounded border-2 border-neutral-900 bg-yellow-400 dark:border-neutral-100">
                                <div class="flex-1">
                                    <div class="mb-4 flex items-center justify-between">
                                        <span class="text-sm">Nº Solicitud - Fecha - Estado</span>
                                        <button class="px-2 text-xl">∧</button>
                                    </div>

                                    {{-- Expanded Content --}}
                                    <div class="space-y-4">
                                        {{-- Meta Information --}}
                                        <div class="space-y-2">
                                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                                <span class="font-medium">Nº Solicitud:</span>
                                                <span
                                                    class="border-b border-neutral-900 px-2 dark:border-neutral-100">_______</span>
                                                <span class="font-medium">Cliente</span>
                                                <span class="font-medium">Tipo: Fallo en la entrega</span>
                                            </div>
                                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                                <span class="font-medium">Fecha:</span>
                                                <div class="flex gap-1">
                                                    <input type="text" value="DD"
                                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                    <input type="text" value="MM"
                                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                    <input type="text" value="AAAA"
                                                        class="w-14 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                </div>
                                                <span class="font-medium">Estado</span>
                                            </div>
                                        </div>

                                        {{-- Content Grid --}}
                                        <div class="grid gap-5 md:grid-cols-2">
                                            {{-- Files Box --}}
                                            <div
                                                class="min-h-[150px] rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                                <div class="flex h-full items-center justify-between">
                                                    <span class="cursor-pointer text-2xl text-neutral-600">‹</span>
                                                    <div class="text-center text-sm leading-relaxed">
                                                        <p>Archivos adjuntos, fotos,</p>
                                                        <p>informes, firmas electrónicas.</p>
                                                    </div>
                                                    <span class="cursor-pointer text-2xl text-neutral-600">›</span>
                                                </div>
                                            </div>

                                            {{-- Details Box --}}
                                            <div
                                                class="min-h-[150px] overflow-y-auto rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                                <p class="text-sm">Información detallada del tipo</p>
                                                <p class="text-sm">de reporte</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </details>
                </div>

                {{-- Add Report Button --}}
                <div class="mb-5 flex flex-col items-center">
                    <button class="btn btn-primary" onclick="my_modal_1.showModal()">Añadir reporte</button>
                    <dialog id="my_modal_1" class="modal">
                        <div class="modal-box max-w-3xl">
                            <div
                                class="mb-8 flex items-start gap-4 rounded border border-neutral-900 bg-neutral-100 p-5 dark:border-neutral-100 dark:bg-neutral-800">
                                <input type="checkbox"
                                    class="mt-0.5 h-5 w-5 flex-shrink-0 appearance-none rounded border-2 border-neutral-900 dark:border-neutral-100">
                                <div class="flex-1 space-y-4">
                                    {{-- Form Meta --}}
                                    <div class="space-y-2">
                                        <div class="flex flex-wrap items-center gap-4 text-sm">
                                            <span class="font-medium">Nº Solicitud:</span>
                                            <span
                                                class="border-b border-neutral-900 px-2 dark:border-neutral-100">_______</span>
                                            <span class="font-medium">Cliente</span>
                                            <span class="font-medium">Tipo: _____</span>
                                        </div>
                                        <div class="flex flex-wrap items-center gap-4 text-sm">
                                            <span class="font-medium">Fecha:</span>
                                            <div class="flex gap-1">
                                                <input type="text" value="DD"
                                                    class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                <input type="text" value="MM"
                                                    class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                <input type="text" value="AAAA"
                                                    class="w-14 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                            </div>
                                            <span class="font-medium">Estado</span>
                                            <select
                                                class="rounded border border-neutral-900 bg-white px-2 py-1 text-xs dark:border-neutral-100 dark:bg-neutral-900">
                                                <option>En Revisión</option>
                                                <option>En Proceso</option>
                                                <option>Enviado</option>
                                                <option>Completado</option>
                                                <option>Incidencia</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Form Content Grid --}}
                                    <div class="grid gap-5 md:grid-cols-2">
                                        {{-- Files Box --}}
                                        <div
                                            class="min-h-[150px] rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                            <div class="flex h-full items-center justify-between">
                                                <span class="cursor-pointer text-2xl text-neutral-600">‹</span>
                                                <div class="text-center text-sm leading-relaxed">
                                                    <p>Archivos adjuntos, fotos,</p>
                                                    <p>informes, firmas electrónicas.</p>
                                                </div>
                                                <span class="cursor-pointer text-2xl text-neutral-600">›</span>
                                            </div>
                                        </div>

                                        {{-- Details Box --}}
                                        <div
                                            class="min-h-[150px] overflow-y-auto rounded border border-neutral-900 bg-white p-4 dark:border-neutral-100 dark:bg-neutral-900">
                                            <p class="text-sm">Información detallada del tipo</p>
                                            <p class="text-sm">de reporte</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-action">
                                <form method="dialog">
                                    <!-- if there is a button in form, it will close the modal -->
                                    <button class="btn btn-primary">Close</button>
                                </form>
                            </div>
                        </div>
                    </dialog>

                </div>

                {{-- New Report Form --}}


                {{-- Pagination --}}
                <div class="flex items-center justify-center gap-4 py-5">
                    <button
                        class="rounded border border-neutral-900 bg-white px-3 py-1 transition hover:bg-neutral-100 dark:border-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800">‹</button>
                    <button
                        class="rounded border border-neutral-900 bg-white px-3 py-1 transition hover:bg-neutral-100 dark:border-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800">‹</button>
                    <span class="text-xs">●</span>
                    <button
                        class="rounded border border-neutral-900 bg-white px-3 py-1 transition hover:bg-neutral-100 dark:border-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800">›</button>
                    <button
                        class="rounded border border-neutral-900 bg-white px-3 py-1 transition hover:bg-neutral-100 dark:border-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800">›</button>
                </div>
            </div>
        </div>


        {{-- Footer --}}
        <footer
            class="border-t border-neutral-900 bg-neutral-100 px-10 py-10 dark:border-neutral-100 dark:bg-neutral-800">
            <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 md:grid-cols-[auto_repeat(3,1fr)_auto]">
                {{-- Logo --}}
                <div class="flex flex-col items-center gap-2">
                    <div
                        class="flex h-16 w-16 items-center justify-center rounded border-2 border-neutral-900 bg-white dark:border-neutral-100 dark:bg-neutral-900">
                        <svg viewBox="0 0 60 60" class="h-12 w-12">
                            <path d="M10 50 L30 10 L50 50 L30 35 Z" fill="#1a5f5f" stroke="#000" stroke-width="2" />
                            <text x="30" y="58" text-anchor="middle" font-size="8" fill="#000">MakeThis</text>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold">MakeThis</span>
                </div>

                {{-- MakeThis Links --}}
                <div class="flex flex-col gap-2">
                    <h3 class="mb-1 text-base font-semibold">MakeThis</h3>
                    <a href="#" class="text-sm hover:opacity-70">Enlace</a>
                    <a href="#" class="text-sm hover:opacity-70">Enlace</a>
                    <a href="#" class="text-sm hover:opacity-70">Enlace</a>
                </div>

                {{-- Legal Links --}}
                <div class="flex flex-col gap-2">
                    <h3 class="mb-1 text-base font-semibold">Aspectos Legales</h3>
                    <a href="#" class="text-sm hover:opacity-70">Enlace</a>
                    <a href="#" class="text-sm hover:opacity-70">Enlace</a>
                    <a href="#" class="text-sm hover:opacity-70">Enlace</a>
                </div>

                {{-- Contact Links --}}
                <div class="flex flex-col gap-2">
                    <h3 class="mb-1 text-base font-semibold">Contacto</h3>
                    <a href="#" class="text-sm hover:opacity-70">Enlace</a>
                    <a href="#" class="text-sm hover:opacity-70">Enlace</a>
                    <a href="#" class="text-sm hover:opacity-70">Enlace</a>
                </div>

                {{-- Social Icons --}}
                <div class="flex gap-2">
                    <div
                        class="flex h-12 w-12 cursor-pointer items-center justify-center rounded border border-neutral-900 bg-neutral-400 text-center text-[10px] leading-tight transition hover:bg-neutral-500 dark:border-neutral-100">
                        Red<br>Social</div>
                    <div
                        class="flex h-12 w-12 cursor-pointer items-center justify-center rounded border border-neutral-900 bg-neutral-400 text-center text-[10px] leading-tight transition hover:bg-neutral-500 dark:border-neutral-100">
                        Red<br>Social</div>
                    <div
                        class="flex h-12 w-12 cursor-pointer items-center justify-center rounded border border-neutral-900 bg-neutral-400 text-center text-[10px] leading-tight transition hover:bg-neutral-500 dark:border-neutral-100">
                        Red<br>Social</div>
                    <div
                        class="flex h-12 w-12 cursor-pointer items-center justify-center rounded border border-neutral-900 bg-neutral-400 text-center text-[10px] leading-tight transition hover:bg-neutral-500 dark:border-neutral-100">
                        Red<br>Social</div>
                </div>
            </div>
        </footer>
    </div>
    </x-layouts::app>