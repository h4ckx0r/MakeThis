@php
$title = 'Solicitudes';
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
                class="flex-1 max-w-[200px] border-r border-neutral-900 bg-neutral-100 px-8 py-3 text-sm transition hover:bg-neutral-200 text-center dark:border-neutral-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">Reportes</a>
            <a href="{{ route('solicitudes') }}"
                class="flex-1 max-w-[200px] border-r border-neutral-900 bg-white px-8 py-3 text-sm font-semibold text-center dark:border-neutral-100 dark:bg-neutral-900">Solicitudes</a>
            <button
                class="flex-1 max-w-[200px] border-r border-neutral-900 bg-neutral-100 px-8 py-3 text-sm transition hover:bg-neutral-200 dark:border-neutral-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">Mensajes</button>
            <a href="{{ route('usuarios') }}"
                class="flex-1 max-w-[200px] border-r border-neutral-900 bg-neutral-100 px-8 py-3 text-sm transition hover:bg-neutral-200 text-center dark:border-neutral-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">Usuarios</a>
            <a href="{{ route('admin.piezas.index') }}"
                class="flex-1 max-w-[200px] border-neutral-900 bg-neutral-100 px-8 py-3 text-sm transition hover:bg-neutral-200 text-center dark:border-neutral-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">Catálogo</a>
        </nav>

        {{-- Main Content --}}
        <div class="flex-1 px-10 py-8">
            <div class="mx-auto max-w-7xl">
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
                    <details
                        class="collapse bg-base-100 border border-neutral-900 dark:border-neutral-100 rounded-lg group"
                        open>
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
                                    <button class="text-2xl cursor-pointer"
                                        onclick="edit_request_modal.showModal()">⋯</button>
                                </div>
                            </div>
                        </div>
                    </details>

                    {{-- Item 2: Aceptada --}}
                    <details
                        class="collapse bg-base-100 border border-neutral-900 dark:border-neutral-100 rounded-lg group">
                        <summary class="collapse-title min-h-0 p-0">
                            <div class="flex items-center justify-between px-4 py-3 text-center text-sm w-full">
                                <span class="flex items-center gap-2">
                                    <span class="text-xl text-green-600">✓</span> {{-- Check Icon --}}
                                    <span class="text-lg">Nº Solicitud - Fecha - Aceptada</span>
                                </span>
                                <span class="text-xl">›</span>
                            </div>
                        </summary>
                        <div class="collapse-content border-t border-neutral-200 dark:border-neutral-700">
                            <div class="p-6">
                                <p>Contenido...</p>
                                <div class="mt-4 flex justify-end">
                                    <button class="text-2xl cursor-pointer"
                                        onclick="edit_request_modal.showModal()">⋯</button>
                                </div>
                            </div>
                        </div>
                    </details>

                    {{-- Item 3: Cancelada --}}
                    <details
                        class="collapse bg-base-100 border border-neutral-900 dark:border-neutral-100 rounded-lg group">
                        <summary class="collapse-title min-h-0 p-0">
                            <div class="flex items-center justify-between px-4 py-3 text-center text-sm w-full">
                                <span class="flex items-center gap-2">
                                    <span class="text-xl text-red-600">✕</span> {{-- Cross Icon --}}
                                    <span class="text-lg">Nº Solicitud - Fecha - Cancelada</span>
                                </span>
                                <span class="text-xl">›</span>
                            </div>
                        </summary>
                        <div class="collapse-content border-t border-neutral-200 dark:border-neutral-700">
                            <div class="p-6">
                                <p>Contenido...</p>
                                <div class="mt-4 flex justify-end">
                                    <button class="text-2xl cursor-pointer"
                                        onclick="edit_request_modal.showModal()">⋯</button>
                                </div>
                            </div>
                        </div>
                    </details>
                    {{-- Item 4: En Proceso --}}
                    <details
                        class="collapse bg-base-100 border border-neutral-900 dark:border-neutral-100 rounded-lg group">
                        <summary class="collapse-title min-h-0 p-0">
                            <div class="flex items-center justify-between px-4 py-3 text-center text-sm w-full">
                                <span class="flex items-center gap-2">
                                    <span class="text-xl">🕒</span>
                                    <span class="text-lg">Nº Solicitud - Fecha - En Proceso</span>
                                </span>
                                <span class="text-xl">›</span>
                            </div>
                        </summary>
                        <div class="collapse-content border-t border-neutral-200 dark:border-neutral-700">
                            <div class="p-6">
                                <p>Contenido...</p>
                                <div class="mt-4 flex justify-end">
                                    <button class="text-2xl cursor-pointer"
                                        onclick="edit_request_modal.showModal()">⋯</button>
                                </div>
                            </div>
                        </div>
                    </details>
                </div>
            </div>
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
                    @for ($i = 0; $i < 4; $i++) <div
                        class="flex h-12 w-12 cursor-pointer items-center justify-center rounded border border-neutral-900 bg-neutral-400 text-center text-[10px] leading-tight transition hover:bg-neutral-500 dark:border-neutral-100">
                        Red<br>Social</div>
                @endfor
            </div>
    </div>
    </footer>
    </div>
    </x-layouts::app>