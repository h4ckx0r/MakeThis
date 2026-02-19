@php $title = 'Catálogo de Piezas'; @endphp

<x-layouts::admin :title="$title">

    {{-- Page Title + Add Button --}}
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-semibold tracking-wide text-base-content">Catálogo de Piezas</h1>
        <button class="btn btn-primary btn-sm" onclick="add_piece_modal.showModal()">
            + Añadir Pieza
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

    {{-- Search (join + GET form) --}}
    <form method="GET" action="{{ route('admin.catalog') }}" class="mb-8">
        <div class="join w-full max-w-md">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar pieza por nombre..."
                class="input join-item input-bordered w-full bg-base-200 border-sky-500/30
                       text-base-content placeholder-base-content/40 focus:border-sky-400 focus:outline-none"
            />
            <button type="submit" class="btn join-item btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
            @if(request('search'))
            <a href="{{ route('admin.catalog') }}" class="btn join-item btn-ghost border-sky-500/30 text-base-content/60">
                ✕
            </a>
            @endif
        </div>
    </form>

    {{-- Catalog Table --}}
    <div class="rounded-xl border border-sky-500/20 overflow-hidden mb-8">
        <table class="table table-zebra table-pin-rows w-full">
            <thead class="bg-base-300">
                <tr class="text-primary text-sm">
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Tags</th>
                    <th class="text-center">Visible</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($piezas as $pieza)
                <tr class="hover:bg-base-200/50 transition-colors">
                    <td class="font-medium text-sm text-base-content">{{ $pieza->nombre }}</td>
                    <td class="text-sm text-base-content/60 max-w-xs">
                        <span class="line-clamp-2">{{ $pieza->descripcion ?? '—' }}</span>
                    </td>
                    <td>
                        <div class="flex flex-wrap gap-1">
                            @forelse ($pieza->tags->take(3) as $tag)
                            <span class="badge badge-soft badge-info badge-xs">{{ $tag->nombre }}</span>
                            @empty
                            <span class="text-xs text-base-content/50">Sin tags</span>
                            @endforelse
                            @if ($pieza->tags->count() > 3)
                            <span class="badge badge-soft badge-neutral badge-xs">+{{ $pieza->tags->count() - 3 }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="text-center">
                        @if ($pieza->visible_catalogo)
                        <span class="badge badge-soft badge-success badge-sm">Visible</span>
                        @else
                        <span class="badge badge-soft badge-neutral badge-sm">Oculta</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="flex gap-2 justify-center">
                            <button
                                class="btn btn-ghost btn-sm text-primary hover:text-primary/80"
                                onclick="openEditModal(
                                    '{{ $pieza->id }}',
                                    '{{ addslashes($pieza->nombre) }}',
                                    '{{ addslashes($pieza->descripcion ?? '') }}',
                                    {{ $pieza->visible_catalogo ? 'true' : 'false' }},
                                    {{ json_encode($pieza->tags->pluck('id')->toArray()) }}
                                )"
                            >
                                Editar
                            </button>
                            <button
                                class="btn btn-ghost btn-sm text-error hover:text-red-400"
                                onclick="openDeleteModal('{{ $pieza->id }}', '{{ addslashes($pieza->nombre) }}')"
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span>No hay piezas disponibles{{ request('search') ? ' para "' . request('search') . '"' : '' }}</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($piezas->hasPages())
    <div class="flex justify-center mb-8">
        <div class="join">
            @if ($piezas->onFirstPage())
            <button class="join-item btn btn-sm btn-disabled">«</button>
            <button class="join-item btn btn-sm btn-disabled">‹</button>
            @else
            <a href="{{ $piezas->url(1) }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">«</a>
            <a href="{{ $piezas->previousPageUrl() }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">‹</a>
            @endif

            @foreach ($piezas->getUrlRange(max(1, $piezas->currentPage() - 2), min($piezas->lastPage(), $piezas->currentPage() + 2)) as $page => $url)
                @if ($page == $piezas->currentPage())
                <button class="join-item btn btn-sm btn-primary">{{ $page }}</button>
                @else
                <a href="{{ $url }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">{{ $page }}</a>
                @endif
            @endforeach

            @if ($piezas->hasMorePages())
            <a href="{{ $piezas->nextPageUrl() }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">›</a>
            <a href="{{ $piezas->url($piezas->lastPage()) }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">»</a>
            @else
            <button class="join-item btn btn-sm btn-disabled">›</button>
            <button class="join-item btn btn-sm btn-disabled">»</button>
            @endif
        </div>
    </div>
    @endif

    {{-- ADD PIEZA MODAL --}}
    <dialog id="add_piece_modal" class="modal">
        <div class="modal-box max-w-2xl bg-base-200 border border-sky-500/30 text-base-content">
            <h3 class="text-xl font-semibold mb-6">Añadir Pieza</h3>

            <form action="{{ route('admin.piezas.store') }}" method="POST">
                @csrf

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Información básica</legend>

                    <div class="mb-3">
                        <label class="label label-text text-base-content/70">Nombre *</label>
                        <input type="text" name="nombre" required
                               value="{{ old('nombre') }}"
                               class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('nombre') border-error @enderror"
                               placeholder="Nombre de la pieza" />
                        @error('nombre')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label label-text text-base-content/70">Descripción</label>
                        <textarea name="descripcion" rows="3"
                                  class="textarea textarea-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 resize-none @error('descripcion') border-error @enderror"
                                  placeholder="Descripción opcional...">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </fieldset>

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Tags <span class="text-xs text-base-content/50 font-normal">(Ctrl/Cmd + clic para selección múltiple)</span></legend>
                    <select name="tags[]" multiple size="5"
                            class="select select-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 h-auto @error('tags') border-error @enderror">
                        @foreach ($availableTags as $tag)
                        <option value="{{ $tag->id }}" @if(in_array($tag->id, old('tags', []))) selected @endif>
                            {{ $tag->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('tags')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="fieldset mb-6">
                    <legend class="fieldset-legend text-base-content/60">Visibilidad</legend>
                    <label class="label cursor-pointer justify-start gap-3">
                        <input type="checkbox" name="visible_catalogo" value="1"
                               class="checkbox checkbox-primary"
                               @if(old('visible_catalogo')) checked @endif />
                        <span class="label-text text-base-content/70">Visible en catálogo público</span>
                    </label>
                </fieldset>

                <div class="modal-action gap-3">
                    <form method="dialog">
                        <button class="btn btn-ghost border-base-300 text-base-content/60">Cancelar</button>
                    </form>
                    <button type="submit" class="btn btn-primary">Guardar Pieza</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button></button>
        </form>
    </dialog>

    {{-- EDIT PIEZA MODAL --}}
    <dialog id="edit_piece_modal" class="modal">
        <div class="modal-box max-w-2xl bg-base-200 border border-sky-500/30 text-base-content">
            <h3 class="text-xl font-semibold mb-6">Editar Pieza</h3>

            <form id="edit_form" method="POST">
                @csrf
                @method('PUT')

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Información básica</legend>

                    <div class="mb-3">
                        <label class="label label-text text-base-content/70">Nombre *</label>
                        <input type="text" id="edit_nombre" name="nombre" required
                               class="input input-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400" />
                    </div>

                    <div>
                        <label class="label label-text text-base-content/70">Descripción</label>
                        <textarea id="edit_descripcion" name="descripcion" rows="3"
                                  class="textarea textarea-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 resize-none"></textarea>
                    </div>
                </fieldset>

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Tags <span class="text-xs text-base-content/50 font-normal">(Ctrl/Cmd + clic para selección múltiple)</span></legend>
                    <select id="edit_tags" name="tags[]" multiple size="5"
                            class="select select-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 h-auto">
                        @foreach ($availableTags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->nombre }}</option>
                        @endforeach
                    </select>
                </fieldset>

                <fieldset class="fieldset mb-6">
                    <legend class="fieldset-legend text-base-content/60">Visibilidad</legend>
                    <label class="label cursor-pointer justify-start gap-3">
                        <input type="checkbox" id="edit_visible" name="visible_catalogo" value="1"
                               class="checkbox checkbox-primary" />
                        <span class="label-text text-base-content/70">Visible en catálogo público</span>
                    </label>
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

    {{-- DELETE PIEZA MODAL --}}
    <dialog id="delete_piece_modal" class="modal">
        <div class="modal-box bg-base-200 border border-error/40 text-base-content text-center">
            <div class="flex justify-center mb-4 text-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="font-bold text-lg mb-2">Confirmar eliminación</h3>
            <p id="delete_title" class="text-base-content/70 mb-2"></p>
            <p class="text-sm text-base-content/50 mb-6">Esta acción no se puede deshacer.</p>

            <form id="delete_form" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex gap-3 justify-center">
                    <button type="button" class="btn btn-ghost border-base-300 text-base-content/60"
                            onclick="delete_piece_modal.close()">
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
        // BUG FIX: firma corregida a 5 parámetros (descripcion y visible ahora se reciben correctamente)
        function openEditModal(id, nombre, descripcion, visible, tags) {
            document.getElementById('edit_nombre').value      = nombre;
            document.getElementById('edit_descripcion').value = descripcion;
            document.getElementById('edit_visible').checked   = visible;

            const tagsSelect = document.getElementById('edit_tags');
            Array.from(tagsSelect.options).forEach(opt => opt.selected = false);
            tags.forEach(tagId => {
                const opt = tagsSelect.querySelector(`option[value="${tagId}"]`);
                if (opt) opt.selected = true;
            });

            const form = document.getElementById('edit_form');
            form.action = `/admin/piezas/${id}`;

            document.getElementById('edit_piece_modal').showModal();
        }

        function openDeleteModal(id, nombre) {
            document.getElementById('delete_title').textContent = `Vas a eliminar: "${nombre}"`;
            const form = document.getElementById('delete_form');
            form.action = `/admin/piezas/${id}`;
            document.getElementById('delete_piece_modal').showModal();
        }
    </script>

</x-layouts::admin>
