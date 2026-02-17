@php
$title = 'Usuarios';
@endphp

<x-layouts::admin :title="$title">
    {{-- Page Title --}}
    <h1 class="mb-5 text-2xl font-semibold text-center">Usuarios</h1>

    {{-- Search and Filter --}}
    <div class="mb-5 flex justify-center">
        <div
            class="flex w-full max-w-md items-center gap-3 rounded border border-neutral-900 bg-white px-4 py-2 dark:border-neutral-100 dark:bg-neutral-900">
            <span class="text-base">🔍</span>
            <input type="text" placeholder="Buscar Usuario"
                class="flex-1 border-none bg-transparent text-sm outline-none text-center">
        </div>
    </div>

    {{-- Users List Header --}}
    <div class="mb-2 grid grid-cols-[1fr_1fr_1fr_auto] gap-4 px-4 py-2 font-medium text-center">
        <span>Nombre</span>
        <span>Correo Electrónico</span>
        <span>Teléfono</span>
        <span>Acciones</span>
    </div>

    {{-- Users List --}}
    <div class="mb-8 flex flex-col gap-2">
        @for ($i = 0; $i < 3; $i++) <details
            class="collapse bg-base-100 border border-neutral-900 dark:border-neutral-100 rounded-lg group">
            <summary class="collapse-title min-h-0 p-0">
                <div class="grid grid-cols-[1fr_1fr_1fr_auto] items-center gap-4 px-4 py-3 text-center text-sm w-full">
                    <span class="text-lg">Juan</span>
                    <span>correodeJuan@gmail.com</span>
                    <span>000000000</span>
                    <div class="flex gap-2 justify-center">
                        <button onclick="event.preventDefault(); document.getElementById('edit_user_modal').showModal()"
                            class="w-6 h-6 hover:text-blue-600">
                            ✏️
                        </button>
                        <button
                            onclick="event.preventDefault(); document.getElementById('delete_user_modal').showModal()"
                            class="w-6 h-6 hover:text-red-600">
                            🗑️
                        </button>
                    </div>
                </div>
            </summary>

            {{-- Expanded Content --}}
            <div class="collapse-content border-t border-neutral-200 dark:border-neutral-700">
                <div class="p-6 relative">
                    {{-- Photo --}}
                    <div
                        class="absolute left-4 top-4 w-28 h-28 border border-neutral-900 bg-white flex items-center justify-center text-center text-sm p-2 rounded">
                        Foto de Perfil
                    </div>

                    {{-- Info Grid --}}
                    <div class="ml-36 grid grid-cols-2 gap-y-4 gap-x-8 text-lg">
                        <div class="flex gap-2">
                            <span>Nombre:</span>
                            <span class="underline">Juan</span>
                        </div>
                        <div class="flex gap-2">
                            <span>Tipo:</span>
                            <span>____</span>
                        </div>
                        <div class="flex gap-2">
                            <span>Apellidos:</span>
                            <span class="underline">Juanez</span>
                        </div>
                        <div class="flex gap-2">
                            <span>Dirección:</span>
                            <span class="underline">Calle Juan, Ciudad de Juan, 0000</span>
                        </div>
                        <div class="flex gap-2 col-span-2">
                            <span>Correo:</span>
                            <span class="underline">correodeJuan@gmail.com</span>
                        </div>
                        <div class="flex gap-2">
                            <span>Tlf:</span>
                            <span class="underline">000000000</span>
                        </div>
                    </div>

                    {{-- Role Badge --}}
                    <div class="absolute top-4 right-4 border border-neutral-900 rounded p-2 text-center w-24">
                        <div class="text-sm font-semibold">Admin</div>
                        <div class="text-xl">👤</div>
                    </div>
                </div>
            </div>
            </details>
            @endfor
    </div>

    {{-- Add User Button --}}
    <div class="mb-5 flex flex-col items-center">
        <button class="rounded-full bg-neutral-300 px-8 py-3 text-xl border border-neutral-900"
            onclick="add_user_modal.showModal()">Añadir Usuario</button>
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

    {{-- Modals --}}
    {{-- Add User Modal --}}
    <dialog id="add_user_modal" class="modal">
        <div class="modal-box max-w-2xl bg-white text-black border border-neutral-900 p-8 rounded-lg">
            <h3 class="font-bold text-2xl text-center mb-6">Añadir Usuario</h3>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <input type="text" placeholder="Nombre" class="w-full border border-neutral-400 p-2 rounded" />
                <input type="text" placeholder="Apellidos" class="w-full border border-neutral-400 p-2 rounded" />
                <input type="email" placeholder="Correo Electrónico"
                    class="w-full border border-neutral-400 p-2 rounded" />
                <input type="text" placeholder="Teléfono" class="w-full border border-neutral-400 p-2 rounded" />
                <input type="text" placeholder="Dirección"
                    class="w-full border border-neutral-400 p-2 rounded col-span-2" />
                <select class="w-full border border-neutral-400 p-2 rounded">
                    <option disabled selected>Rol</option>
                    <option>Admin</option>
                    <option>User</option>
                </select>
                <div class="flex items-center gap-2">
                    <span class="text-sm">Foto de Perfil</span>
                    <input type="file" class="file-input file-input-bordered file-input-sm w-full max-w-xs" />
                </div>
            </div>
            <div class="modal-action justify-center">
                <form method="dialog">
                    <button class="btn btn-neutral text-white px-8">Guardar</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    {{-- Edit User Modal --}}
    <dialog id="edit_user_modal" class="modal">
        <div class="modal-box max-w-2xl bg-white text-black border border-neutral-900 p-8 rounded-lg">
            <h3 class="font-bold text-2xl text-center mb-6">Editar Usuario</h3>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <input type="text" value="Juan" class="w-full border border-neutral-400 p-2 rounded" />
                <input type="text" value="Juanez" class="w-full border border-neutral-400 p-2 rounded" />
                <input type="email" value="correodeJuan@gmail.com"
                    class="w-full border border-neutral-400 p-2 rounded" />
                <input type="text" value="000000000" class="w-full border border-neutral-400 p-2 rounded" />
                <input type="text" value="Calle Juan, Ciudad de Juan, 0000"
                    class="w-full border border-neutral-400 p-2 rounded col-span-2" />
                <select class="w-full border border-neutral-400 p-2 rounded">
                    <option disabled>Rol</option>
                    <option selected>Admin</option>
                    <option>User</option>
                </select>
                <div class="flex items-center gap-2">
                    <span class="text-sm">Cambiar Foto</span>
                    <input type="file" class="file-input file-input-bordered file-input-sm w-full max-w-xs" />
                </div>
            </div>
            <div class="modal-action justify-center">
                <form method="dialog">
                    <button class="btn btn-neutral text-white px-8">Guardar Cambios</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    {{-- Delete Confirmation Modal --}}
    <dialog id="delete_user_modal" class="modal">
        <div class="modal-box bg-white text-black border border-neutral-900 p-8 rounded-lg text-center">
            <h3 class="font-bold text-lg mb-4">¿Estás seguro de que quieres eliminar este usuario?</h3>
            <p class="mb-6">Esta acción no se puede deshacer.</p>
            <div class="flex gap-4 justify-center">
                <form method="dialog">
                    <button class="btn btn-outline">Cancelar</button>
                    <button class="btn btn-error text-white ml-2">Eliminar</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</x-layouts::admin>