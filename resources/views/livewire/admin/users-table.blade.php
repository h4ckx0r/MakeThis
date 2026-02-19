<div class="px-6 py-4">

    {{-- Flash messages --}}
    @if (session('success'))
    <div class="mb-4 rounded-lg border border-green-500/30 bg-green-500/10 px-4 py-3 text-sm text-green-400">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="mb-4 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-400">
        {{ session('error') }}
    </div>
    @endif

    {{-- Toolbar: search + add button --}}
    <div class="mb-5 flex items-center gap-3">
        <div class="relative flex-1 max-w-sm">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-neutral-400" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" wire:model.live.debounce.300ms="search"
                placeholder="Buscar por nombre, email o teléfono…"
                class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 py-2 pl-9 pr-4 text-sm text-white placeholder-neutral-500 focus:border-sky-500/50 focus:outline-none focus:ring-1 focus:ring-sky-500/30" />
        </div>

        <span class="text-xs text-neutral-500">{{ $users->total() }} usuario(s)</span>

        <button wire:click="openCreateModal"
            class="ml-auto flex items-center gap-2 rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-500 transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Añadir usuario
        </button>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto rounded-xl border border-sky-500/20">
        <table class="w-full text-sm text-left text-neutral-300">
            <thead class="bg-neutral-900 text-xs uppercase text-neutral-500 border-b border-sky-500/20">
                <tr>
                    <th class="px-4 py-3 cursor-pointer hover:text-sky-400 select-none" wire:click="sortBy('nombre')">
                        <div class="flex items-center gap-1">
                            Nombre
                            @if ($sortField === 'nombre')
                            <svg class="h-3 w-3 {{ $sortDirection === 'asc' ? '' : 'rotate-180' }}" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            @endif
                        </div>
                    </th>
                    <th class="px-4 py-3 cursor-pointer hover:text-sky-400 select-none" wire:click="sortBy('email')">
                        <div class="flex items-center gap-1">
                            Email
                            @if ($sortField === 'email')
                            <svg class="h-3 w-3 {{ $sortDirection === 'asc' ? '' : 'rotate-180' }}" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            @endif
                        </div>
                    </th>
                    <th class="px-4 py-3">Teléfono</th>
                    <th class="px-4 py-3">Dirección</th>
                    <th class="px-4 py-3 text-center cursor-pointer hover:text-sky-400 select-none"
                        wire:click="sortBy('isAdmin')">
                        <div class="flex items-center justify-center gap-1">
                            Rol
                            @if ($sortField === 'isAdmin')
                            <svg class="h-3 w-3 {{ $sortDirection === 'asc' ? '' : 'rotate-180' }}" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            @endif
                        </div>
                    </th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sky-500/10">
                @forelse ($users as $user)
                <tr class="bg-neutral-950 hover:bg-neutral-900 transition-colors">
                    <td class="px-4 py-3 font-medium text-white">
                        {{ $user->nombre }} {{ $user->apellidos }}
                    </td>
                    <td class="px-4 py-3 text-neutral-400">{{ $user->email }}</td>
                    <td class="px-4 py-3 text-neutral-400">{{ $user->telefono ?? '—' }}</td>
                    <td class="px-4 py-3 text-neutral-400 max-w-[180px] truncate" title="{{ $user->direccion }}">
                        {{ $user->direccion ?? '—' }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        <button wire:click="toggleAdmin('{{ $user->id }}')" @disabled($user->id === auth()->id())
                            title="{{ $user->id === auth()->id() ? 'No puedes cambiar tu propio rol' : '' }}"
                            class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-semibold
                            transition
                            {{ $user->isAdmin ? 'bg-sky-500/20 text-sky-400 hover:bg-sky-500/30' : 'bg-neutral-700/50
                            text-neutral-400 hover:bg-neutral-700' }}
                            disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                            {{ $user->isAdmin ? 'Admin' : 'Usuario' }}
                        </button>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            {{-- Edit button --}}
                            <button wire:click="openEditModal('{{ $user->id }}')"
                                class="rounded px-2.5 py-1 text-xs bg-sky-500/10 text-sky-400 border border-sky-500/20 hover:bg-sky-500/20 transition">
                                Editar
                            </button>

                            {{-- Delete --}}
                            @if ($confirmingDeleteId === $user->id)
                            <button wire:click="deleteUser('{{ $user->id }}')"
                                class="rounded px-2 py-1 text-xs bg-red-600 hover:bg-red-700 text-white transition">
                                Confirmar
                            </button>
                            <button wire:click="cancelDelete"
                                class="rounded px-2 py-1 text-xs bg-neutral-700 hover:bg-neutral-600 text-white transition">
                                Cancelar
                            </button>
                            @else
                            <button wire:click="confirmDelete('{{ $user->id }}')" @disabled($user->id === auth()->id())
                                title="{{ $user->id === auth()->id() ? 'No puedes eliminarte a ti mismo' : '' }}"
                                class="rounded px-2.5 py-1 text-xs bg-red-500/10 text-red-400 border border-red-500/20
                                hover:bg-red-500/20 transition disabled:opacity-40 disabled:cursor-not-allowed"
                                >
                                Eliminar
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-10 text-center text-neutral-500">
                        No se encontraron usuarios.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($users->hasPages())
    <div class="mt-4">
        {{ $users->links() }}
    </div>
    @endif

    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    {{-- Create User Modal --}}
    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    @if ($showCreateModal)
    <div class="fixed inset-0 z-40 bg-black/60 backdrop-blur-sm" wire:click="closeCreateModal"></div>
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="w-full max-w-lg rounded-2xl border border-sky-500/20 bg-neutral-950 shadow-2xl">

            <div class="flex items-center justify-between border-b border-sky-500/20 px-6 py-4">
                <h2 class="text-base font-semibold text-white">Añadir usuario</h2>
                <button wire:click="closeCreateModal" class="text-neutral-400 hover:text-white transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="createUser" class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1 block text-xs font-medium text-neutral-400">Nombre <span
                                class="text-red-400">*</span></label>
                        <input type="text" wire:model="nombre" placeholder="Juan"
                            class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 px-3 py-2 text-sm text-white placeholder-neutral-600 focus:border-sky-500/50 focus:outline-none @error('nombre') border-red-500/50 @enderror" />
                        @error('nombre') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium text-neutral-400">Apellidos <span
                                class="text-red-400">*</span></label>
                        <input type="text" wire:model="apellidos" placeholder="García López"
                            class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 px-3 py-2 text-sm text-white placeholder-neutral-600 focus:border-sky-500/50 focus:outline-none @error('apellidos') border-red-500/50 @enderror" />
                        @error('apellidos') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-xs font-medium text-neutral-400">Email <span
                            class="text-red-400">*</span></label>
                    <input type="email" wire:model="email" placeholder="juan@ejemplo.com"
                        class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 px-3 py-2 text-sm text-white placeholder-neutral-600 focus:border-sky-500/50 focus:outline-none @error('email') border-red-500/50 @enderror" />
                    @error('email') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1 block text-xs font-medium text-neutral-400">Teléfono <span
                            class="text-red-400">*</span></label>
                    <input type="tel" wire:model="telefono" placeholder="+34 600 000 000"
                        class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 px-3 py-2 text-sm text-white placeholder-neutral-600 focus:border-sky-500/50 focus:outline-none @error('telefono') border-red-500/50 @enderror" />
                    @error('telefono') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1 block text-xs font-medium text-neutral-400">Dirección <span
                            class="text-neutral-600 text-xs">(opcional)</span></label>
                    <input type="text" wire:model="direccion" placeholder="Calle Mayor 1, Madrid"
                        class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 px-3 py-2 text-sm text-white placeholder-neutral-600 focus:border-sky-500/50 focus:outline-none @error('direccion') border-red-500/50 @enderror" />
                    @error('direccion') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1 block text-xs font-medium text-neutral-400">Contraseña <span
                                class="text-red-400">*</span></label>
                        <input type="password" wire:model="password" placeholder="Mínimo 8 caracteres"
                            class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 px-3 py-2 text-sm text-white placeholder-neutral-600 focus:border-sky-500/50 focus:outline-none @error('password') border-red-500/50 @enderror" />
                        @error('password') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium text-neutral-400">Confirmar contraseña <span
                                class="text-red-400">*</span></label>
                        <input type="password" wire:model="password_confirmation" placeholder="Repite la contraseña"
                            class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 px-3 py-2 text-sm text-white placeholder-neutral-600 focus:border-sky-500/50 focus:outline-none" />
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" wire:click="$toggle('isAdmin')"
                        class="relative inline-flex h-5 w-9 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus:outline-none {{ $isAdmin ? 'bg-sky-600' : 'bg-neutral-700' }}"
                        role="switch" aria-checked="{{ $isAdmin ? 'true' : 'false' }}">
                        <span
                            class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow transition duration-200 {{ $isAdmin ? 'translate-x-4' : 'translate-x-0' }}"></span>
                    </button>
                    <span class="text-sm text-neutral-300">Administrador <span class="ml-1 text-xs text-neutral-500">({{
                            $isAdmin ? 'Sí' : 'No' }})</span></span>
                </div>

                <div class="flex justify-end gap-3 pt-2 border-t border-sky-500/10">
                    <button type="button" wire:click="closeCreateModal"
                        class="rounded-lg px-4 py-2 text-sm text-neutral-400 hover:text-white hover:bg-neutral-800 transition">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="rounded-lg bg-sky-600 px-5 py-2 text-sm font-semibold text-white hover:bg-sky-500 transition">
                        Crear usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    {{-- Edit User Modal --}}
    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    @if ($showEditModal)
    <div class="fixed inset-0 z-40 bg-black/60 backdrop-blur-sm" wire:click="closeEditModal"></div>
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="w-full max-w-lg rounded-2xl border border-sky-500/20 bg-neutral-950 shadow-2xl">

            <div class="flex items-center justify-between border-b border-sky-500/20 px-6 py-4">
                <h2 class="text-base font-semibold text-white">Editar usuario</h2>
                <button wire:click="closeEditModal" class="text-neutral-400 hover:text-white transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="updateUser" class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1 block text-xs font-medium text-neutral-400">Nombre <span
                                class="text-red-400">*</span></label>
                        <input type="text" wire:model="editNombre"
                            class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 px-3 py-2 text-sm text-white placeholder-neutral-600 focus:border-sky-500/50 focus:outline-none @error('editNombre') border-red-500/50 @enderror" />
                        @error('editNombre') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium text-neutral-400">Apellidos <span
                                class="text-red-400">*</span></label>
                        <input type="text" wire:model="editApellidos"
                            class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 px-3 py-2 text-sm text-white placeholder-neutral-600 focus:border-sky-500/50 focus:outline-none @error('editApellidos') border-red-500/50 @enderror" />
                        @error('editApellidos') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-xs font-medium text-neutral-400">Email <span
                            class="text-red-400">*</span></label>
                    <input type="email" wire:model="editEmail"
                        class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 px-3 py-2 text-sm text-white placeholder-neutral-600 focus:border-sky-500/50 focus:outline-none @error('editEmail') border-red-500/50 @enderror" />
                    @error('editEmail') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1 block text-xs font-medium text-neutral-400">Teléfono <span
                            class="text-red-400">*</span></label>
                    <input type="tel" wire:model="editTelefono"
                        class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 px-3 py-2 text-sm text-white placeholder-neutral-600 focus:border-sky-500/50 focus:outline-none @error('editTelefono') border-red-500/50 @enderror" />
                    @error('editTelefono') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1 block text-xs font-medium text-neutral-400">Dirección <span
                            class="text-neutral-600 text-xs">(opcional)</span></label>
                    <input type="text" wire:model="editDireccion" placeholder="Calle Mayor 1, Madrid"
                        class="w-full rounded-lg border border-sky-500/20 bg-neutral-900 px-3 py-2 text-sm text-white placeholder-neutral-600 focus:border-sky-500/50 focus:outline-none @error('editDireccion') border-red-500/50 @enderror" />
                    @error('editDireccion') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" wire:click="$toggle('editIsAdmin')"
                        class="relative inline-flex h-5 w-9 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus:outline-none {{ $editIsAdmin ? 'bg-sky-600' : 'bg-neutral-700' }}"
                        role="switch" aria-checked="{{ $editIsAdmin ? 'true' : 'false' }}">
                        <span
                            class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow transition duration-200 {{ $editIsAdmin ? 'translate-x-4' : 'translate-x-0' }}"></span>
                    </button>
                    <span class="text-sm text-neutral-300">Administrador <span class="ml-1 text-xs text-neutral-500">({{
                            $editIsAdmin ? 'Sí' : 'No' }})</span></span>
                    @error('editIsAdmin') <p class="ml-2 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end gap-3 pt-2 border-t border-sky-500/10">
                    <button type="button" wire:click="closeEditModal"
                        class="rounded-lg px-4 py-2 text-sm text-neutral-400 hover:text-white hover:bg-neutral-800 transition">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="rounded-lg bg-sky-600 px-5 py-2 text-sm font-semibold text-white hover:bg-sky-500 transition">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

</div>