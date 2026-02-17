@php
$title = 'Reportes';
@endphp

<x-layouts::admin :title="$title">
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
        {{-- Report items repeat as before --}}
        @for ($i = 0; $i < 7; $i++) <details class="collapse bg-base-100 border border-base-300"
            name="my-accordion-det-1" @if($i===0) open @endif>
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
            @endfor
    </div>

    {{-- Add Report Button --}}
    <div class="mb-5 flex flex-col items-center">
        <button class="rounded-full bg-neutral-300 px-8 py-3 text-xl border border-neutral-900"
            onclick="my_modal_1.showModal()">Añadir reporte</button>
        <dialog id="my_modal_1" class="modal">
            <div class="modal-box max-w-3xl bg-white text-black">
                <div class="mb-8 flex items-start gap-4 rounded border border-neutral-900 bg-neutral-100 p-5">
                    <input type="checkbox"
                        class="mt-0.5 h-5 w-5 flex-shrink-0 appearance-none rounded border-2 border-neutral-900">
                    <div class="flex-1 space-y-4">
                        {{-- Form Meta --}}
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                <span class="font-medium">Nº Solicitud:</span>
                                <span class="border-b border-neutral-900 px-2">_______</span>
                                <span class="font-medium">Cliente</span>
                                <span class="font-medium">Tipo: _____</span>
                            </div>
                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                <span class="font-medium">Fecha:</span>
                                <div class="flex gap-1">
                                    <input type="text" value="DD"
                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs">
                                    <input type="text" value="MM"
                                        class="w-10 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs">
                                    <input type="text" value="AAAA"
                                        class="w-14 rounded border border-neutral-900 bg-white px-2 py-1 text-center text-xs">
                                </div>
                                <span class="font-medium">Estado</span>
                                <select class="rounded border border-neutral-900 bg-white px-2 py-1 text-xs">
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
                            <div class="min-h-[150px] rounded border border-neutral-900 bg-white p-4">
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
                            <div class="min-h-[150px] overflow-y-auto rounded border border-neutral-900 bg-white p-4">
                                <p class="text-sm">Información detallada del tipo</p>
                                <p class="text-sm">de reporte</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-action justify-center gap-4">
                    <form method="dialog">
                        <button
                            class="rounded-full bg-neutral-300 px-8 py-3 text-xl border border-neutral-900">Cancelar</button>
                        <button
                            class="rounded-full bg-neutral-300 px-8 py-3 text-xl border border-neutral-900 ml-2">Guardar
                            Reporte</button>
                    </form>
                </div>
            </div>
        </dialog>
    </div>

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
</x-layouts::admin>