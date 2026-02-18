@php
$title = 'Solicitudes';
@endphp

<x-layouts::admin :title="$title">
    {{-- Page Title --}}
    <h1 class="mb-8 text-3xl font-semibold text-center text-white tracking-wide">
        Solicitudes
    </h1>

    {{-- Search and Filter --}}
    <div class="mb-8 flex justify-center items-center gap-4">
        <div
            class="flex w-full max-w-md items-center gap-3 rounded-xl border border-sky-500/40 bg-black px-4 py-3 shadow-sm">
            <span class="text-sky-400 text-lg">🔍</span>
            <input type="text" placeholder="Buscar Nº Solicitud"
                class="flex-1 bg-transparent text-sm text-white placeholder-neutral-400 outline-none text-center">
        </div>

        <button
            class="flex items-center gap-2 rounded-xl border border-sky-500/40 bg-black px-5 py-3 text-sm text-white hover:bg-sky-500/10 transition">
            Filtrar
            <span class="text-sky-400">☰</span>
        </button>
    </div>

    {{-- Requests List --}}
    <div class="mb-10 flex flex-col gap-4">

        {{-- Item 1: En Proceso --}}
        <details class="group rounded-xl border border-sky-500/30 bg-neutral-950 open:shadow-lg transition" open>
            <summary class="cursor-pointer list-none">
                <div class="flex items-center justify-between px-5 py-4 text-sm text-white">
                    <span class="flex items-center gap-3">
                        <span class="text-xl text-sky-400">🕒</span>
                        <span class="text-base font-medium">
                            Nº Solicitud · Fecha · En Proceso
                        </span>
                    </span>
                    <span class="text-xl text-sky-400 transition-transform group-open:rotate-90">
                        ›
                    </span>
                </div>
            </summary>

            {{-- Expanded Content --}}
            <div class="border-t border-sky-500/20">
                <div class="p-6 space-y-6 text-white">

                    {{-- Meta Info --}}
                    <div class="grid grid-cols-4 gap-4 text-sm text-neutral-300">
                        <span>Nº Solicitud</span>
                        <span>Fecha dd/mm/yyyy</span>
                        <span>Cliente</span>
                        <span class="text-sky-400 font-medium">Aceptada</span>
                    </div>

                    {{-- Main Content --}}
                    <div class="grid grid-cols-2 gap-8">
                        <div
                            class="h-40 rounded-xl border border-sky-500/30 bg-black p-4 flex items-center justify-center text-center text-neutral-400">
                            Archivos adjuntos, fotos, informes…
                        </div>

                        <div
                            class="h-40 rounded-xl border border-sky-500/30 bg-black p-4 flex items-center justify-center text-center text-neutral-400">
                            Información detallada de la solicitud
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button class="text-2xl text-sky-400 hover:text-sky-300 transition"
                            onclick="edit_request_modal.showModal()">
                            ⋯
                        </button>
                    </div>
                </div>
            </div>
        </details>

        {{-- More items --}}
        @for ($i = 0; $i < 3; $i++) <details
            class="group rounded-xl border border-sky-500/30 bg-neutral-950 transition">
            <summary class="cursor-pointer list-none">
                <div class="flex items-center justify-between px-5 py-4 text-sm text-white">
                    <span class="flex items-center gap-3">
                        @if($i === 0)
                        <span class="text-xl text-green-400">✓</span>
                        <span class="font-medium">Nº Solicitud · Fecha · Aceptada</span>
                        @elseif($i === 1)
                        <span class="text-xl text-red-400">✕</span>
                        <span class="font-medium">Nº Solicitud · Fecha · Cancelada</span>
                        @else
                        <span class="text-xl text-sky-400">🕒</span>
                        <span class="font-medium">Nº Solicitud · Fecha · En Proceso</span>
                        @endif
                    </span>
                    <span class="text-xl text-sky-400 transition-transform group-open:rotate-90">
                        ›
                    </span>
                </div>
            </summary>

            <div class="border-t border-sky-500/20">
                <div class="p-6 text-neutral-300">
                    <p>Contenido…</p>
                    <div class="mt-4 flex justify-end">
                        <button class="text-2xl text-sky-400 hover:text-sky-300 transition"
                            onclick="edit_request_modal.showModal()">
                            ⋯
                        </button>
                    </div>
                </div>
            </div>
            </details>
            @endfor
    </div>

    {{-- Edit Request Modal --}}
    <dialog id="edit_request_modal" class="modal">
        <div class="modal-box max-w-3xl bg-black text-white border border-sky-500/40 p-8 rounded-2xl">
            <h3 class="text-2xl font-semibold text-center mb-8">
                Editar Solicitud
            </h3>

            <div class="grid gap-6 mb-8">

                {{-- Status Select --}}
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-neutral-300">Estado</label>
                    <select
                        class="w-full rounded-xl border border-sky-500/30 bg-black p-3 text-white focus:outline-none focus:ring-1 focus:ring-sky-400">
                        <option>En Proceso</option>
                        <option>Aceptada</option>
                        <option>Cancelada</option>
                        <option>En Revisión</option>
                    </select>
                </div>

                {{-- Detailed Info --}}
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-neutral-300">
                        Información detallada
                    </label>
                    <textarea
                        class="h-32 rounded-xl border border-sky-500/30 bg-black p-3 text-white resize-none focus:outline-none focus:ring-1 focus:ring-sky-400"
                        placeholder="Escribe aquí los detalles…"></textarea>
                </div>

                {{-- File Upload --}}
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-neutral-300">
                        Adjuntar archivos
                    </label>
                    <input type="file"
                        class="file-input file-input-bordered w-full bg-black border-sky-500/30 text-white" multiple />
                </div>
            </div>

            <div class="modal-action justify-center gap-4">
                <form method="dialog">
                    <button
                        class="rounded-full border border-neutral-500 px-8 py-3 text-sm text-neutral-300 hover:bg-neutral-800 transition">
                        Cancelar
                    </button>
                    <button
                        class="ml-2 rounded-full bg-sky-500 px-8 py-3 text-sm font-medium text-black hover:bg-sky-400 transition">
                        Guardar
                    </button>
                </form>
            </div>
        </div>

        <form method="dialog" class="modal-backdrop bg-black/70">
            <button></button>
        </form>
    </dialog>
</x-layouts::admin>