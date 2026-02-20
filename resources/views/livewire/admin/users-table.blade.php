<div>

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

    {{-- Toolbar: search + counter + add button --}}
    <div class="mb-8 flex items-center gap-4">
        <div class="join flex-1 max-w-md">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Buscar por nombre, email o teléfono…"
                class="input join-item input-bordered w-full bg-base-200 border-sky-500/30
                       text-base-content placeholder-base-content/40 focus:border-sky-400 focus:outline-none"
            />
        </div>
        <span class="text-xs text-base-content/50">{{ $users->total() }} usuario(s)</span>
        <button wire:click="openCreateModal" class="btn btn-primary btn-sm ml-auto">
            + Añadir usuario
        </button>
    </div>

    {{-- Users Table --}}
    <div class="rounded-xl border border-sky-500/20 overflow-hidden mb-8">
        <table class="table table-zebra table-pin-rows w-full">
            <thead class="bg-base-300">
                <tr class="text-primary text-sm">
                    <th class="cursor-pointer select-none hover:text-primary/80" wire:click="sortBy('nombre')">
                        <div class="flex items-center gap-1">
                            Nombre
                            @if ($sortField === 'nombre')
                            <svg class="h-3 w-3 {{ $sortDirection === 'asc' ? '' : 'rotate-180' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            @endif
                        </div>
                    </th>
                    <th class="cursor-pointer select-none hover:text-primary/80" wire:click="sortBy('email')">
                        <div class="flex items-center gap-1">
                            Email
                            @if ($sortField === 'email')
                            <svg class="h-3 w-3 {{ $sortDirection === 'asc' ? '' : 'rotate-180' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            @endif
                        </div>
                    </th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th class="text-center cursor-pointer select-none hover:text-primary/80" wire:click="sortBy('isAdmin')">
                        <div class="flex items-center justify-center gap-1">
                            Rol
                            @if ($sortField === 'isAdmin')
                            <svg class="h-3 w-3 {{ $sortDirection === 'asc' ? '' : 'rotate-180' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            @endif
                        </div>
                    </th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr class="hover:bg-base-200/50 transition-colors">
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar placeholder">
                                <div class="bg-primary/20 text-primary rounded-full flex justify-center items-center w-10 h-10">
                                    <span class="text-sm font-semibold">
                                        {{ strtoupper(substr($user->nombre ?? '?', 0, 1)) }}{{ strtoupper(substr($user->apellidos ?? '', 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div class="font-medium text-sm text-base-content">
                                    {{ $user->nombre }} {{ $user->apellidos }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-sm text-base-content/70">{{ $user->email }}</td>
                    <td class="text-sm text-base-content/70">{{ $user->telefono ?? '—' }}</td>
                    <td class="text-sm text-base-content/70 max-w-45 truncate" title="{{ $user->direccion }}">
                        {{ $user->direccion ?? '—' }}
                    </td>
                    <td class="text-center">
                        <button
                            wire:click="toggleAdmin('{{ $user->id }}')"
                            @disabled($user->id === auth()->id())
                            title="{{ $user->id === auth()->id() ? 'No puedes cambiar tu propio rol' : 'Click para cambiar rol' }}"
                            class="{{ $user->isAdmin
                                ? 'badge badge-soft badge-primary badge-sm'
                                : 'badge badge-soft badge-neutral badge-sm' }}
                                cursor-pointer hover:opacity-80 transition-opacity
                                disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            {{ $user->isAdmin ? 'Admin' : 'Usuario' }}
                        </button>
                    </td>
                    <td class="text-center">
                        <div class="flex gap-2 justify-center">
                            <button
                                wire:click="openEditModal('{{ $user->id }}')"
                                class="btn btn-ghost btn-sm text-primary hover:text-primary/80"
                            >
                                Editar
                            </button>

                            @if ($confirmingDeleteId === $user->id)
                            <button
                                wire:click="deleteUser('{{ $user->id }}')"
                                class="btn btn-error btn-sm"
                            >
                                Confirmar
                            </button>
                            <button
                                wire:click="cancelDelete"
                                class="btn btn-ghost btn-sm"
                            >
                                Cancelar
                            </button>
                            @else
                            <button
                                wire:click="confirmDelete('{{ $user->id }}')"
                                @disabled($user->id === auth()->id())
                                title="{{ $user->id === auth()->id() ? 'No puedes eliminarte a ti mismo' : '' }}"
                                class="btn btn-ghost btn-sm text-error hover:text-error/80 disabled:opacity-40"
                            >
                                Eliminar
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-16 text-base-content/50">
                        <div class="flex flex-col items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>No hay usuarios{{ $search ? ' con "' . $search . '"' : '' }}</span>
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
            <button wire:click="gotoPage(1)" class="join-item btn btn-sm btn-ghost border-sky-500/30">«</button>
            <button wire:click="previousPage" class="join-item btn btn-sm btn-ghost border-sky-500/30">‹</button>
            @endif

            @foreach ($users->getUrlRange(max(1, $users->currentPage() - 2), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                @if ($page == $users->currentPage())
                <button class="join-item btn btn-sm btn-primary">{{ $page }}</button>
                @else
                <button wire:click="gotoPage({{ $page }})" class="join-item btn btn-sm btn-ghost border-sky-500/30">{{ $page }}</button>
                @endif
            @endforeach

            @if ($users->hasMorePages())
            <button wire:click="nextPage" class="join-item btn btn-sm btn-ghost border-sky-500/30">›</button>
            <button wire:click="gotoPage({{ $users->lastPage() }})" class="join-item btn btn-sm btn-ghost border-sky-500/30">»</button>
            @else
            <button class="join-item btn btn-sm btn-disabled">›</button>
            <button class="join-item btn btn-sm btn-disabled">»</button>
            @endif
        </div>
    </div>
    @endif

    {{-- CREATE USER MODAL --}}
    @if ($showCreateModal)
    <div class="modal modal-open">
        <div class="modal-box max-w-2xl bg-base-200 border border-sky-500/30 text-base-content">
            <h3 class="text-xl font-semibold mb-6">Añadir Usuario</h3>

            <form wire:submit.prevent="createUser">

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Datos personales</legend>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="label label-text text-base-content/70">Nombre *</label>
                            <input type="text" wire:model="nombre"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('nombre') border-error @enderror"
                                   placeholder="Juan" />
                            @error('nombre') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="label label-text text-base-content/70">Apellidos *</label>
                            <input type="text" wire:model="apellidos"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('apellidos') border-error @enderror"
                                   placeholder="García López" />
                            @error('apellidos') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="label label-text text-base-content/70">Email *</label>
                            <input type="email" wire:model="email"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('email') border-error @enderror"
                                   placeholder="juan@ejemplo.com" />
                            @error('email') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="label label-text text-base-content/70">Teléfono *</label>
                            <input type="tel" wire:model="telefono"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('telefono') border-error @enderror"
                                   placeholder="+34 600 000 000" />
                            @error('telefono') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="col-span-2">
                            <label class="label label-text text-base-content/70">Dirección <span class="text-xs text-base-content/50">(opcional)</span></label>
                            <input type="text" wire:model="direccion"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('direccion') border-error @enderror"
                                   placeholder="Calle Mayor 1, Madrid" />
                            @error('direccion') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Contraseña *</legend>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <input type="password" wire:model="password"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('password') border-error @enderror"
                                   placeholder="Mínimo 8 caracteres" />
                            @error('password') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <input type="password" wire:model="password_confirmation"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400"
                                   placeholder="Repite la contraseña" />
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset mb-6">
                    <legend class="fieldset-legend text-base-content/60">Configuración</legend>
                    <div>
                        <label class="label label-text text-base-content/70">Rol</label>
                        <select wire:model="isAdmin"
                                class="select select-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 max-w-xs">
                            <option value="0">Usuario</option>
                            <option value="1">Administrador</option>
                        </select>
                    </div>
                </fieldset>

                <div class="modal-action gap-3">
                    <button type="button" wire:click="closeCreateModal"
                            class="btn btn-ghost border-base-300 text-base-content/60">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </div>
            </form>
        </div>
        <div class="modal-backdrop" wire:click="closeCreateModal"></div>
    </div>
    @endif

    {{-- EDIT USER MODAL --}}
    @if ($showEditModal)
    <div class="modal modal-open">
        <div class="modal-box max-w-2xl bg-base-200 border border-sky-500/30 text-base-content">
            <h3 class="text-xl font-semibold mb-6">Editar Usuario</h3>

            <form wire:submit.prevent="updateUser">

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Datos personales</legend>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="label label-text text-base-content/70">Nombre *</label>
                            <input type="text" wire:model="editNombre"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('editNombre') border-error @enderror" />
                            @error('editNombre') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="label label-text text-base-content/70">Apellidos *</label>
                            <input type="text" wire:model="editApellidos"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('editApellidos') border-error @enderror" />
                            @error('editApellidos') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="label label-text text-base-content/70">Email *</label>
                            <input type="email" wire:model="editEmail"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('editEmail') border-error @enderror" />
                            @error('editEmail') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="label label-text text-base-content/70">Teléfono *</label>
                            <input type="tel" wire:model="editTelefono"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('editTelefono') border-error @enderror" />
                            @error('editTelefono') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="col-span-2">
                            <label class="label label-text text-base-content/70">Dirección <span class="text-xs text-base-content/50">(opcional)</span></label>
                            <input type="text" wire:model="editDireccion"
                                   class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('editDireccion') border-error @enderror"
                                   placeholder="Calle Mayor 1, Madrid" />
                            @error('editDireccion') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset mb-6">
                    <legend class="fieldset-legend text-base-content/60">Configuración</legend>
                    <div>
                        <label class="label label-text text-base-content/70">Rol</label>
                        <select wire:model="editIsAdmin"
                                class="select select-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 max-w-xs">
                            <option value="0">Usuario</option>
                            <option value="1">Administrador</option>
                        </select>
                        @error('editIsAdmin') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </fieldset>

                <div class="modal-action gap-3">
                    <button type="button" wire:click="closeEditModal"
                            class="btn btn-ghost border-base-300 text-base-content/60">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
        <div class="modal-backdrop" wire:click="closeEditModal"></div>
    </div>
    @endif

</div>
