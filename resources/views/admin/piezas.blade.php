@php
$title = 'Catálogo de Piezas';
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
                class="flex-1 max-w-[200px] border-r border-neutral-900 bg-neutral-100 px-8 py-3 text-sm transition hover:bg-neutral-200 text-center dark:border-neutral-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">Solicitudes</a>
            <button
                class="flex-1 max-w-[200px] border-r border-neutral-900 bg-neutral-100 px-8 py-3 text-sm transition hover:bg-neutral-200 dark:border-neutral-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">Mensajes</button>
            <a href="{{ route('usuarios') }}"
                class="flex-1 max-w-[200px] border-r border-neutral-900 bg-neutral-100 px-8 py-3 text-sm transition hover:bg-neutral-200 text-center dark:border-neutral-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">Usuarios</a>
            <a href="{{ route('admin.piezas.index') }}"
                class="flex-1 max-w-[200px] border-neutral-900 bg-white px-8 py-3 text-sm font-semibold text-center dark:border-neutral-100 dark:bg-neutral-900">Catálogo</a>
        </nav>

        {{-- Main Content --}}
        <div class="flex-1 px-10 py-8">
            <div class="mx-auto max-w-7xl">
                {{-- Page Title --}}
                <h1 class="mb-5 text-2xl font-semibold text-center">Catálogo de Piezas</h1>

                {{-- Alerts --}}
                @if (session('success'))
                    <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-lg bg-red-100 border border-red-400 text-red-700 px-4 py-3">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Search --}}
                <div class="mb-5 flex justify-center">
                    <form method="GET" action="{{ route('admin.piezas.index') }}" class="w-full max-w-md">
                        <div
                            class="flex items-center gap-3 rounded border border-neutral-900 bg-white px-4 py-2 dark:border-neutral-100 dark:bg-neutral-900">
                            <span class="text-base">🔍</span>
                            <input type="text" name="search" placeholder="Buscar Pieza"
                                value="{{ request('search') }}"
                                class="flex-1 border-none bg-transparent text-sm outline-none text-center">
                        </div>
                    </form>
                </div>

                {{-- Piezas List Header --}}
                <div class="mb-2 grid grid-cols-[1.5fr_2fr_1.5fr_auto_auto] gap-4 px-4 py-2 font-medium text-center">
                    <span>Nombre</span>
                    <span>Descripción</span>
                    <span>Tags</span>
                    <span>Visible</span>
                    <span>Acciones</span>
                </div>

                {{-- Piezas List --}}
                <div class="mb-8 flex flex-col gap-2">
                    @forelse ($piezas as $pieza)
                        <details class="collapse bg-base-100 border border-neutral-900 dark:border-neutral-100 rounded-lg group">
                            <summary class="collapse-title min-h-0 p-0">
                                <div
                                    class="grid grid-cols-[1.5fr_2fr_1.5fr_auto_auto] items-center gap-4 px-4 py-3 text-center text-sm w-full">
                                    <span class="font-medium">{{ $pieza->nombre }}</span>
                                    <span class="text-xs truncate">{{ $pieza->descripcion ?? '—' }}</span>
                                    <div class="flex flex-wrap gap-1 justify-center">
                                        @forelse ($pieza->tags->take(3) as $tag)
                                            <span class="badge badge-sm bg-neutral-200 text-neutral-900 border-neutral-400">{{ $tag->nombre }}</span>
                                        @empty
                                            <span class="text-xs text-neutral-500">Sin tags</span>
                                        @endforelse
                                        @if ($pieza->tags->count() > 3)
                                            <span class="badge badge-sm bg-neutral-300 text-neutral-900 border-neutral-400">+{{ $pieza->tags->count() - 3 }}</span>
                                        @endif
                                    </div>
                                    <span class="text-sm">{{ $pieza->visible_catalogo ? '✓' : '✗' }}</span>
                                    <div class="flex gap-2 justify-center">
                                        <button
                                            onclick="event.preventDefault(); openEditModal({{ $pieza->id }}, '{{ addslashes($pieza->nombre) }}', '{{ addslashes($pieza->descripcion ?? '') }}', {{ $pieza->visible_catalogo ? 'true' : 'false' }}, {{ json_encode($pieza->tags->pluck('id')->toArray()) }})"
                                            class="w-6 h-6 hover:text-blue-600">
                                            ✏️
                                        </button>
                                        <button
                                            onclick="event.preventDefault(); openDeleteModal({{ $pieza->id }}, '{{ addslashes($pieza->nombre) }}')"
                                            class="w-6 h-6 hover:text-red-600">
                                            🗑️
                                        </button>
                                    </div>
                                </div>
                            </summary>

                            {{-- Expanded Content --}}
                            <div class="collapse-content border-t border-neutral-200 dark:border-neutral-700">
                                <div class="p-6 space-y-4">
                                    <div class="flex gap-2">
                                        <span class="font-medium min-w-32">Nombre:</span>
                                        <span class="text-neutral-700 dark:text-neutral-300">{{ $pieza->nombre }}</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <span class="font-medium min-w-32">Descripción:</span>
                                        <span class="text-neutral-700 dark:text-neutral-300">{{ $pieza->descripcion ?? '—' }}</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <span class="font-medium min-w-32">Tags:</span>
                                        <div class="flex flex-wrap gap-2">
                                            @forelse ($pieza->tags as $tag)
                                                <span class="badge badge-sm bg-neutral-200 text-neutral-900 border-neutral-400">{{ $tag->nombre }}</span>
                                            @empty
                                                <span class="text-neutral-500">Sin tags asignados</span>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <span class="font-medium min-w-32">Visible:</span>
                                        <span class="text-neutral-700 dark:text-neutral-300">{{ $pieza->visible_catalogo ? 'Sí, visible en catálogo público' : 'No, oculta del catálogo público' }}</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <span class="font-medium min-w-32">Creada:</span>
                                        <span class="text-neutral-700 dark:text-neutral-300">{{ $pieza->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </details>
                    @empty
                        <div class="text-center py-8 text-neutral-500">
                            No hay piezas disponibles.
                        </div>
                    @endforelse
                </div>

                {{-- Add Pieza Button --}}
                <div class="mb-5 flex flex-col items-center">
                    <button class="rounded-full bg-neutral-300 px-8 py-3 text-xl border border-neutral-900"
                        onclick="add_piece_modal.showModal()">Añadir Pieza</button>
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
            </div>
        </div>

        {{-- Modals --}}

        {{-- Add Pieza Modal --}}
        <dialog id="add_piece_modal" class="modal">
            <div class="modal-box max-w-2xl bg-white text-black border border-neutral-900 p-8 rounded-lg">
                <h3 class="font-bold text-2xl text-center mb-6">Añadir Pieza</h3>
                <form action="{{ route('admin.piezas.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Nombre *</label>
                            <input type="text" name="nombre" required
                                class="w-full border border-neutral-400 p-2 rounded @error('nombre') border-red-500 @enderror"
                                value="{{ old('nombre') }}" />
                            @error('nombre')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Descripción</label>
                            <textarea name="descripcion" rows="3"
                                class="w-full border border-neutral-400 p-2 rounded @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Tags</label>
                            <select name="tags[]" multiple size="5"
                                class="w-full border border-neutral-400 p-2 rounded @error('tags') border-red-500 @enderror">
                                @foreach ($availableTags as $tag)
                                    <option value="{{ $tag->id }}"
                                        @if (in_array($tag->id, old('tags', []))) selected @endif>
                                        {{ $tag->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-neutral-500 mt-1">Mantén presionado Ctrl/Cmd para seleccionar múltiples</p>
                            @error('tags')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="visible_catalogo" value="1"
                                @if (old('visible_catalogo')) checked @endif
                                class="w-4 h-4 border border-neutral-400 rounded" />
                            <span class="text-sm font-medium">Visible en catálogo público</span>
                        </label>
                    </div>
                    <div class="modal-action justify-center gap-4">
                        <form method="dialog">
                            <button type="button" class="btn btn-outline">Cancelar</button>
                        </form>
                        <button type="submit" class="btn btn-neutral text-white">Guardar</button>
                    </div>
                </form>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>

        {{-- Edit Pieza Modal --}}
        <dialog id="edit_piece_modal" class="modal">
            <div class="modal-box max-w-2xl bg-white text-black border border-neutral-900 p-8 rounded-lg">
                <h3 class="font-bold text-2xl text-center mb-6">Editar Pieza</h3>
                <form id="edit_form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Nombre *</label>
                            <input type="text" id="edit_nombre" name="nombre" required
                                class="w-full border border-neutral-400 p-2 rounded" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Descripción</label>
                            <textarea id="edit_descripcion" name="descripcion" rows="3"
                                class="w-full border border-neutral-400 p-2 rounded"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Tags</label>
                            <select id="edit_tags" name="tags[]" multiple size="5"
                                class="w-full border border-neutral-400 p-2 rounded">
                                @foreach ($availableTags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->nombre }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-neutral-500 mt-1">Mantén presionado Ctrl/Cmd para seleccionar múltiples</p>
                        </div>

                        <label class="flex items-center gap-2">
                            <input type="checkbox" id="edit_visible" name="visible_catalogo" value="1"
                                class="w-4 h-4 border border-neutral-400 rounded" />
                            <span class="text-sm font-medium">Visible en catálogo público</span>
                        </label>
                    </div>
                    <div class="modal-action justify-center gap-4">
                        <form method="dialog">
                            <button type="button" class="btn btn-outline">Cancelar</button>
                        </form>
                        <button type="submit" class="btn btn-neutral text-white">Guardar Cambios</button>
                    </div>
                </form>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>

        {{-- Delete Pieza Modal --}}
        <dialog id="delete_piece_modal" class="modal">
            <div class="modal-box bg-white text-black border border-neutral-900 p-8 rounded-lg text-center">
                <h3 class="font-bold text-lg mb-4" id="delete_title">¿Estás seguro de que quieres eliminar esta pieza?</h3>
                <p class="mb-6">Esta acción no se puede deshacer.</p>
                <form id="delete_form" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-4 justify-center">
                        <button type="button" class="btn btn-outline" onclick="delete_piece_modal.close()">Cancelar</button>
                        <button type="submit" class="btn btn-error text-white">Eliminar</button>
                    </div>
                </form>
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
                    @for ($i = 0; $i < 4; $i++)
                        <div
                            class="flex h-12 w-12 cursor-pointer items-center justify-center rounded border border-neutral-900 bg-neutral-400 text-center text-[10px] leading-tight transition hover:bg-neutral-500 dark:border-neutral-100">
                            Red<br>Social</div>
                    @endfor
                </div>
            </div>
        </footer>
    </div>

    <script>
        function openEditModal(id, nombre, descripcion, visible, tags) {
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_descripcion').value = descripcion;
            document.getElementById('edit_visible').checked = visible;

            // Deseleccionar todos los tags primero
            const tagsSelect = document.getElementById('edit_tags');
            Array.from(tagsSelect.options).forEach(option => {
                option.selected = false;
            });

            // Seleccionar solo los tags de esta pieza
            tags.forEach(tagId => {
                const option = tagsSelect.querySelector(`option[value="${tagId}"]`);
                if (option) option.selected = true;
            });

            // Actualizar action del formulario
            const form = document.getElementById('edit_form');
            form.action = `/admin/piezas/${id}`;

            document.getElementById('edit_piece_modal').showModal();
        }

        function openDeleteModal(id, nombre) {
            document.getElementById('delete_title').textContent = `¿Estás seguro de que quieres eliminar "${nombre}"?`;
            const form = document.getElementById('delete_form');
            form.action = `/admin/piezas/${id}`;
            document.getElementById('delete_piece_modal').showModal();
        }
    </script>
</x-layouts::basic>
