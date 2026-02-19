@php $title = 'Usuarios'; @endphp

<x-layouts::admin :title="$title">

    {{-- Page Title + Add Button --}}
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-semibold tracking-wide text-base-content">Usuarios</h1>
        <button class="btn btn-primary btn-sm" onclick="add_user_modal.showModal()">
            + Añadir Usuario
        </button>
    </div>

    {{-- Flash alerts --}}
    @if (session('success'))
    <div role="alert" class="alert alert-success mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif
    @if (session('error'))
    <div role="alert" class="alert alert-error mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    {{-- Search (join) --}}
    <form method="GET" action="{{ route('admin.users') }}" class="mb-8">
        <div class="join w-full max-w-md">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar por nombre o email..."
                class="input join-item input-bordered w-full bg-base-200 border-sky-500/30
                       text-base-content placeholder-base-content/40 focus:border-sky-400 focus:outline-none"
            />
            <button type="submit" class="btn join-item btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
    </form>

    {{-- Users Table --}}
    <div class="rounded-xl border border-sky-500/20 overflow-hidden mb-8">
        <table class="table table-zebra table-pin-rows w-full">
            <thead class="bg-base-300">
                <tr class="text-primary text-sm">
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr class="hover:bg-base-200/50 transition-colors">
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar placeholder">
                                <div class="bg-primary/20 text-primary rounded-full w-10 h-10">
                                    <span class="text-sm font-semibold">
                                        {{ strtoupper(substr($user->nombre ?? '?', 0, 1)) }}{{ strtoupper(substr($user->apellidos ?? '', 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div class="font-medium text-sm text-base-content">
                                    {{ $user->nombre }} {{ $user->apellidos }}
                                </div>
                                <div class="text-xs text-base-content/50">{{ $user->direccion ?? 'Sin dirección' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-sm text-base-content/70">{{ $user->email }}</td>
                    <td class="text-sm text-base-content/70">{{ $user->telefono ?? '—' }}</td>
                    <td>
                        @if ($user->isAdmin)
                        <span class="badge badge-soft badge-primary badge-sm">Admin</span>
                        @else
                        <span class="badge badge-soft badge-neutral badge-sm">Usuario</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="flex gap-2 justify-center">
                            <button
                                class="btn btn-ghost btn-sm text-primary hover:text-primary/80"
                                onclick="openEditUserModal(
                                    '{{ $user->id }}',
                                    '{{ addslashes($user->nombre ?? '') }}',
                                    '{{ addslashes($user->apellidos ?? '') }}',
                                    '{{ addslashes($user->email) }}',
                                    '{{ addslashes($user->telefono ?? '') }}',
                                    '{{ addslashes($user->direccion ?? '') }}',
                                    {{ $user->isAdmin ? 'true' : 'false' }}
                                )"
                            >
                                Editar
                            </button>
                            <button
                                class="btn btn-ghost btn-sm text-error hover:text-red-400"
                                onclick="openDeleteUserModal(
                                    '{{ $user->id }}',
                                    '{{ addslashes(($user->nombre ?? '') . ' ' . ($user->apellidos ?? '')) }}'
                                )"
                            >
                                Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-16 text-base-content/50">
                        <div class="flex flex-col items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>No hay usuarios{{ request('search') ? ' con "' . request('search') . '"' : '' }}</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($users->hasPages())
    <div class="flex justify-center mb-8">
        <div class="join">
            @if ($users->onFirstPage())
            <button class="join-item btn btn-sm btn-disabled">«</button>
            <button class="join-item btn btn-sm btn-disabled">‹</button>
            @else
            <a href="{{ $users->url(1) }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">«</a>
            <a href="{{ $users->previousPageUrl() }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">‹</a>
            @endif

            @foreach ($users->getUrlRange(max(1, $users->currentPage() - 2), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                @if ($page == $users->currentPage())
                <button class="join-item btn btn-sm btn-primary">{{ $page }}</button>
                @else
                <a href="{{ $url }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">{{ $page }}</a>
                @endif
            @endforeach

            @if ($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">›</a>
            <a href="{{ $users->url($users->lastPage()) }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">»</a>
            @else
            <button class="join-item btn btn-sm btn-disabled">›</button>
            <button class="join-item btn btn-sm btn-disabled">»</button>
            @endif
        </div>
    </div>
    @endif

    {{-- ADD USER MODAL --}}
    <dialog id="add_user_modal" class="modal">
        <div class="modal-box max-w-2xl bg-base-200 border border-sky-500/30 text-base-content">
            <h3 class="text-xl font-semibold mb-6">Añadir Usuario</h3>

            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Datos personales</legend>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="label label-text text-base-content/70">Nombre *</label>
                            <input type="text" name="nombre" required
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400"
                                   placeholder="Nombre" />
                        </div>
                        <div>
                            <label class="label label-text text-base-content/70">Apellidos</label>
                            <input type="text" name="apellidos"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400"
                                   placeholder="Apellidos" />
                        </div>
                        <div>
                            <label class="label label-text text-base-content/70">Email *</label>
                            <input type="email" name="email" required
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400"
                                   placeholder="email@ejemplo.com" />
                        </div>
                        <div>
                            <label class="label label-text text-base-content/70">Teléfono</label>
                            <input type="text" name="telefono"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400"
                                   placeholder="000 000 000" />
                        </div>
                        <div class="col-span-2">
                            <label class="label label-text text-base-content/70">Dirección</label>
                            <input type="text" name="direccion"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400"
                                   placeholder="Calle, Ciudad, CP" />
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Contraseña *</legend>
                    <input type="password" name="password" required
                           class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400"
                           placeholder="Contraseña inicial" />
                </fieldset>

                <fieldset class="fieldset mb-6">
                    <legend class="fieldset-legend text-base-content/60">Configuración</legend>
                    <div class="flex items-end gap-4">
                        <div class="flex-1">
                            <label class="label label-text text-base-content/70">Rol</label>
                            <select name="isAdmin"
                                    class="select select-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400">
                                <option value="0">Usuario</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label class="label label-text text-base-content/70">Foto de perfil</label>
                            <input type="file" name="foto" accept="image/*"
                                   class="file-input file-input-bordered w-full bg-base-300 border-sky-500/30 text-base-content" />
                        </div>
                    </div>
                </fieldset>

                <div class="modal-action gap-3">
                    <form method="dialog">
                        <button class="btn btn-ghost border-base-300 text-base-content/60">Cancelar</button>
                    </form>
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button></button>
        </form>
    </dialog>

    {{-- EDIT USER MODAL --}}
    <dialog id="edit_user_modal" class="modal">
        <div class="modal-box max-w-2xl bg-base-200 border border-sky-500/30 text-base-content">
            <h3 class="text-xl font-semibold mb-6">Editar Usuario</h3>

            <form id="edit_user_form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Datos personales</legend>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="label label-text text-base-content/70">Nombre *</label>
                            <input type="text" id="edit_user_nombre" name="nombre" required
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400" />
                        </div>
                        <div>
                            <label class="label label-text text-base-content/70">Apellidos</label>
                            <input type="text" id="edit_user_apellidos" name="apellidos"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400" />
                        </div>
                        <div>
                            <label class="label label-text text-base-content/70">Email *</label>
                            <input type="email" id="edit_user_email" name="email" required
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400" />
                        </div>
                        <div>
                            <label class="label label-text text-base-content/70">Teléfono</label>
                            <input type="text" id="edit_user_telefono" name="telefono"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400" />
                        </div>
                        <div class="col-span-2">
                            <label class="label label-text text-base-content/70">Dirección</label>
                            <input type="text" id="edit_user_direccion" name="direccion"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400" />
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset mb-6">
                    <legend class="fieldset-legend text-base-content/60">Configuración</legend>
                    <div class="flex items-end gap-4">
                        <div class="flex-1">
                            <label class="label label-text text-base-content/70">Rol</label>
                            <select id="edit_user_isAdmin" name="isAdmin"
                                    class="select select-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400">
                                <option value="0">Usuario</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label class="label label-text text-base-content/70">Cambiar foto</label>
                            <input type="file" name="foto" accept="image/*"
                                   class="file-input file-input-bordered w-full bg-base-300 border-sky-500/30 text-base-content" />
                        </div>
                    </div>
                </fieldset>

                <div class="modal-action gap-3">
                    <form method="dialog">
                        <button class="btn btn-ghost border-base-300 text-base-content/60">Cancelar</button>
                    </form>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button></button>
        </form>
    </dialog>

    {{-- DELETE USER MODAL --}}
    <dialog id="delete_user_modal" class="modal">
        <div class="modal-box bg-base-200 border border-error/40 text-base-content text-center">
            <div class="flex justify-center mb-4 text-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="font-bold text-lg mb-2">Confirmar eliminación</h3>
            <p id="delete_user_name" class="text-base-content/70 mb-2"></p>
            <p class="text-sm text-base-content/50 mb-6">Esta acción no se puede deshacer.</p>

            <form id="delete_user_form" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex gap-3 justify-center">
                    <button type="button" class="btn btn-ghost border-base-300 text-base-content/60"
                            onclick="delete_user_modal.close()">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-error">Eliminar</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button></button>
        </form>
    </dialog>

    <script>
        function openEditUserModal(id, nombre, apellidos, email, telefono, direccion, isAdmin) {
            document.getElementById('edit_user_nombre').value    = nombre;
            document.getElementById('edit_user_apellidos').value = apellidos;
            document.getElementById('edit_user_email').value     = email;
            document.getElementById('edit_user_telefono').value  = telefono;
            document.getElementById('edit_user_direccion').value = direccion;
            document.getElementById('edit_user_isAdmin').value   = isAdmin ? '1' : '0';

            const form = document.getElementById('edit_user_form');
            form.action = '/admin/users/' + id;

            document.getElementById('edit_user_modal').showModal();
        }

        function openDeleteUserModal(id, nombreCompleto) {
            document.getElementById('delete_user_name').textContent = 'Vas a eliminar a: ' + nombreCompleto.trim();

            const form = document.getElementById('delete_user_form');
            form.action = '/admin/users/' + id;

            document.getElementById('delete_user_modal').showModal();
        }
    </script>

</x-layouts::admin>
