@php $title = 'Solicitudes'; @endphp

<x-layouts::admin :title="$title">

    {{-- Page Title --}}
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-semibold tracking-wide text-base-content">Solicitudes</h1>
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

    {{-- Search + Filter --}}
    <form method="GET" action="{{ route('admin.requests') }}" class="mb-8 flex flex-wrap items-end gap-4">
        <div class="join flex-1 min-w-60 max-w-md">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar por Nº solicitud o cliente..."
                class="input join-item input-bordered w-full bg-base-200 border-sky-500/30
                       text-base-content placeholder-base-content/40 focus:border-sky-400 focus:outline-none"
            />
            <button type="submit" class="btn join-item btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>

        <select name="estado"
                class="select select-bordered bg-base-200 border-sky-500/30 text-base-content focus:border-sky-400 min-w-45"
                onchange="this.form.submit()">
            <option value="">Todos los estados</option>
            <option value="pendiente"  @selected(request('estado') === 'pendiente')>Pendiente</option>
            <option value="en_proceso" @selected(request('estado') === 'en_proceso')>En Proceso</option>
            <option value="completada" @selected(request('estado') === 'completada')>Completada</option>
            <option value="rechazada"  @selected(request('estado') === 'rechazada')>Rechazada</option>
        </select>

        @if(request('search') || request('estado'))
        <a href="{{ route('admin.requests') }}" class="btn btn-ghost border-sky-500/30 text-base-content/60 btn-sm self-end">
            Limpiar filtros
        </a>
        @endif
    </form>

    {{-- Requests Table --}}
    <div class="rounded-xl border border-sky-500/20 overflow-hidden mb-8">
        <table class="table table-zebra table-pin-rows w-full">
            <thead class="bg-base-300">
                <tr class="text-primary text-sm">
                    <th>Nº Solicitud</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($solicitudes as $sol)
                @php
                    $estadoNombre = $sol->estado->nombreEstado ?? 'pendiente';
                    $badgeClass = match($estadoNombre) {
                        'pendiente'  => 'badge-warning',
                        'en_proceso' => 'badge-info',
                        'completada' => 'badge-success',
                        'rechazada'  => 'badge-error',
                        default      => 'badge-neutral',
                    };
                    $estadoLabel = match($estadoNombre) {
                        'pendiente'  => 'Pendiente',
                        'en_proceso' => 'En Proceso',
                        'completada' => 'Completada',
                        'rechazada'  => 'Rechazada',
                        default      => ucfirst($estadoNombre),
                    };
                @endphp
                <tr class="hover:bg-base-200/50 transition-colors">
                    <td class="font-mono text-xs text-primary">
                        #{{ substr($sol->id, 24, 36) }}
                    </td>
                    <td class="text-sm text-base-content/70">
                        {{ $sol->created_at->format('d/m/Y') }}
                        <span class="block text-xs text-base-content/50">{{ $sol->created_at->format('H:i') }}</span>
                    </td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar placeholder">
                                <div class="bg-primary/20 text-primary rounded-full w-9 h-9 text-xs flex justify-center items-center font-semibold">
                                    <span>{{ strtoupper(substr($sol->user->nombre ?? '?', 0, 1)) }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-base-content">
                                    {{ $sol->user->nombre ?? 'Sin nombre' }} {{ $sol->user->apellidos ?? '' }}
                                </div>
                                <div class="text-xs text-base-content/50">{{ $sol->user->email ?? '' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-soft {{ $badgeClass }} badge-sm">{{ $estadoLabel }}</span>
                    </td>
                    <td class="text-center">
                        <button
                            class="btn btn-ghost btn-sm text-primary hover:text-primary/80"
                            onclick="openRequestModal(
                                '{{ $sol->id }}',
                                '{{ substr($sol->id, 24, 36) }}',
                                '{{ addslashes(($sol->user->nombre ?? '') . ' ' . ($sol->user->apellidos ?? '')) }}',
                                '{{ $estadoNombre }}',
                                '{{ addslashes($sol->detalles ?? '') }}'
                            )"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Editar
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-16 text-base-content/50">
                        <div class="flex flex-col items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>No hay solicitudes{{ request('search') ? ' para "' . request('search') . '"' : '' }}</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($solicitudes->hasPages())
    <div class="flex justify-center mb-8">
        <div class="join">
            @if ($solicitudes->onFirstPage())
            <button class="join-item btn btn-sm btn-disabled">«</button>
            <button class="join-item btn btn-sm btn-disabled">‹</button>
            @else
            <a href="{{ $solicitudes->url(1) }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">«</a>
            <a href="{{ $solicitudes->previousPageUrl() }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">‹</a>
            @endif

            @foreach ($solicitudes->getUrlRange(max(1, $solicitudes->currentPage() - 2), min($solicitudes->lastPage(), $solicitudes->currentPage() + 2)) as $page => $url)
                @if ($page == $solicitudes->currentPage())
                <button class="join-item btn btn-sm btn-primary">{{ $page }}</button>
                @else
                <a href="{{ $url }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">{{ $page }}</a>
                @endif
            @endforeach

            @if ($solicitudes->hasMorePages())
            <a href="{{ $solicitudes->nextPageUrl() }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">›</a>
            <a href="{{ $solicitudes->url($solicitudes->lastPage()) }}" class="join-item btn btn-sm btn-ghost border-sky-500/30">»</a>
            @else
            <button class="join-item btn btn-sm btn-disabled">›</button>
            <button class="join-item btn btn-sm btn-disabled">»</button>
            @endif
        </div>
    </div>
    @endif

    {{-- Edit/View Request Modal --}}
    <dialog id="edit_request_modal" class="modal">
        <div class="modal-box max-w-2xl bg-base-200 border border-sky-500/30 text-base-content">
            <h3 class="text-xl font-semibold mb-1">Editar Solicitud</h3>
            <p id="modal_solicitud_id" class="text-xs font-mono text-primary/70 mb-6"></p>

            <form id="edit_request_form" method="POST">
                @csrf
                @method('PUT')

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Cliente</legend>
                    <p id="modal_cliente_nombre" class="text-sm text-base-content px-1 py-1"></p>
                </fieldset>

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Estado</legend>
                    <select id="modal_estado" name="estado"
                            class="select select-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400">
                        <option value="pendiente">Pendiente</option>
                        <option value="en_proceso">En Proceso</option>
                        <option value="completada">Completada</option>
                        <option value="rechazada">Rechazada</option>
                    </select>
                </fieldset>

                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Notas / Detalles</legend>
                    <textarea id="modal_detalles" name="detalles"
                              class="textarea textarea-bordered w-full h-32 bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 resize-none"
                              placeholder="Detalles adicionales..."></textarea>
                </fieldset>

                <fieldset class="fieldset mb-6">
                    <legend class="fieldset-legend text-base-content/60">Adjuntar archivo</legend>
                    <input type="file"
                           class="file-input file-input-bordered w-full bg-base-300 border-sky-500/30 text-base-content"
                           multiple />
                </fieldset>

                <div class="modal-action gap-3">
                    <form method="dialog">
                        <button class="btn btn-ghost border-base-300 text-base-content/60">Cancelar</button>
                    </form>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button></button>
        </form>
    </dialog>

    <script>
        function openRequestModal(id, shortId, cliente, estado, detalles) {
            document.getElementById('modal_solicitud_id').textContent = '#' + shortId;
            document.getElementById('modal_cliente_nombre').textContent = cliente.trim();
            document.getElementById('modal_detalles').value = detalles;
            document.getElementById('modal_estado').value = estado;

            const form = document.getElementById('edit_request_form');
            form.action = '/admin/requests/' + id;

            document.getElementById('edit_request_modal').showModal();
        }
    </script>

</x-layouts::admin>
