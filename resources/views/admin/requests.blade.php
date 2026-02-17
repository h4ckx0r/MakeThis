@php
$title = 'Solicitudes';
@endphp

<x-layouts::admin :title="$title">
    {{-- Page Title --}}
    <h1 class="mb-5 text-2xl font-semibold text-center">Solicitudes</h1>

    {{-- Search and Filter --}}
    <div class="mb-5 flex justify-center items-center gap-4">
        <div
            class="flex w-full max-w-md items-center gap-3 rounded border border-neutral-900 bg-white px-4 py-2 dark:border-neutral-100 dark:bg-neutral-900">
            <span class="text-base">🔍</span>
            <input type="text" placeholder="Buscar Nº Solicitud"
                class="flex-1 border-none bg-transparent text-sm outline-none text-center">
        </div>
        <button
            class="flex items-center gap-2 rounded border border-neutral-900 px-4 py-2 text-sm bg-white dark:bg-neutral-900 dark:border-neutral-100">
            Filtrar
            <span>☰</span>
        </button>
    </div>

    {{-- Requests List --}}
    <div class="mb-8 flex flex-col gap-2">
        {{-- Item 1: En Proceso --}}
        <details class="collapse bg-base-100 border border-neutral-900 dark:border-neutral-100 rounded-lg group" open>
            <summary class="collapse-title min-h-0 p-0">
                <div class="flex items-center justify-between px-4 py-3 text-center text-sm w-full">
                    <span class="flex items-center gap-2">
                        <span class="text-xl">🕒</span> {{-- Clock Icon --}}
                        <span class="text-lg">Nº Solicitud - Fecha - En Proceso</span>
                    </span>
                    <span class="text-xl">›</span>
                </div>
            </summary>

            {{-- Expanded Content --}}
            <div class="collapse-content border-t border-neutral-200 dark:border-neutral-700">
                <div class="p-6">
                    {{-- Meta Info --}}
                    <div class="flex justify-between text-lg mb-6">
                        <span>Nº Solicitud</span>
                        <span>Fecha dd/mm/YYYY</span>
                        <span>Cliente</span>
                        <span>Estado: Aceptada</span>
                    </div>

                    {{-- Main Content --}}
                    <div class="grid grid-cols-2 gap-8">
                        {{-- Attachments --}}
                        <div
                            class="h-40 border border-neutral-900 rounded p-4 flex items-center justify-center text-center">
                            Archivos adjuntos, fotos, informes, .
                        </div>
                        {{-- Details --}}
                        <div
                            class="h-40 border border-neutral-900 rounded p-4 flex items-center justify-center text-center">
                            Información detallada de la solicitud, tamaño, material, idea, etc.
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button class="text-2xl cursor-pointer" onclick="edit_request_modal.showModal()">⋯</button>
                    </div>
                </div>
            </div>
        </details>

        {{-- More items ... --}}
        @for ($i = 0; $i < 3; $i++) <details
            class="collapse bg-base-100 border border-neutral-900 dark:border-neutral-100 rounded-lg group">
            <summary class="collapse-title min-h-0 p-0">
                <div class="flex items-center justify-between px-4 py-3 text-center text-sm w-full">
                    <span class="flex items-center gap-2">
                        @if($i === 0)
                        <span class="text-xl text-green-600">✓</span>
                        <span class="text-lg">Nº Solicitud - Fecha - Aceptada</span>
                        @elseif($i === 1)
                        <span class="text-xl text-red-600">✕</span>
                        <span class="text-lg">Nº Solicitud - Fecha - Cancelada</span>
                        @else
                        <span class="text-xl">🕒</span>
                        <span class="text-lg">Nº Solicitud - Fecha - En Proceso</span>
                        @endif
                    </span>
                    <span class="text-xl">›</span>
                </div>
            </summary>
            <div class="collapse-content border-t border-neutral-200 dark:border-neutral-700">
                <div class="p-6">
                    <p>Contenido...</p>
                    <div class="mt-4 flex justify-end">
                        <button class="text-2xl cursor-pointer" onclick="edit_request_modal.showModal()">⋯</button>
                    </div>
                </div>
            </div>
            </details>
            @endfor
    </div>

    {{-- Edit Request Modal --}}
    <dialog id="edit_request_modal" class="modal">
        <div class="modal-box max-w-3xl bg-white text-black border border-neutral-900 p-8 rounded-lg">
            <h3 class="font-bold text-2xl text-center mb-6">Editar Solicitud</h3>

            <div class="grid gap-6 mb-6">
                {{-- Status Select --}}
                <div class="flex flex-col gap-2">
                    <label class="font-semibold">Estado</label>
                    <select class="w-full border border-neutral-400 p-2 rounded bg-white">
                        <option>En Proceso</option>
                        <option>Aceptada</option>
                        <option>Cancelada</option>
                        <option>En Revisión</option>
                    </select>
                </div>

                {{-- Detailed Info --}}
                <div class="flex flex-col gap-2">
                    <label class="font-semibold">Información Detallada (Tamaño, Material, Idea...)</label>
                    <textarea class="w-full h-32 border border-neutral-400 p-2 rounded bg-white resize-none"
                        placeholder="Escribe aquí los detalles..."></textarea>
                </div>

                {{-- File Upload --}}
                <div class="flex flex-col gap-2">
                    <label class="font-semibold">Adjuntar Archivos</label>
                    <input type="file" class="file-input file-input-bordered w-full border-neutral-400 bg-white"
                        multiple />
                </div>
            </div>

            <div class="modal-action justify-center gap-4">
                <form method="dialog">
                    <button
                        class="rounded-full bg-neutral-300 px-8 py-3 text-xl border border-neutral-900">Cancelar</button>
                    <button
                        class="rounded-full bg-neutral-300 px-8 py-3 text-xl border border-neutral-900 ml-2">Guardar</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</x-layouts::admin>