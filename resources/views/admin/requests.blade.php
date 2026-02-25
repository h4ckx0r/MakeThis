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

        <select name="estado_id"
                class="select select-bordered bg-base-200 border-sky-500/30 text-base-content focus:border-sky-400 min-w-45"
                onchange="this.form.submit()">
            <option value="">Todos los estados</option>
            @foreach ($estados as $estado)
            <option value="{{ $estado->id }}" @selected(request('estado_id') === $estado->id)>
                {{ $estado->nombreEstado }}
            </option>
            @endforeach
        </select>

        @if(request('search') || request('estado_id'))
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
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($solicitudes as $sol)
                @php
                    $estadoNombre = $sol->estado->nombreEstado ?? '';
                    $estadoId     = $sol->estado->id ?? '';
                    $badgeClass   = match(true) {
                        in_array($estadoNombre, ['Pendiente', 'En revision'])                        => 'badge-warning',
                        in_array($estadoNombre, ['Aprobada', 'En impresion', 'Control de calidad']) => 'badge-info',
                        $estadoNombre === 'Completada'                                               => 'badge-success',
                        in_array($estadoNombre, ['Rechazada', 'Cancelada'])                         => 'badge-error',
                        default                                                                      => 'badge-neutral',
                    };
                    $adjuntosJson = json_encode(
                        $sol->adjuntos->map(fn($a) => [
                            'id'     => $a->id,
                            'nombre' => $a->nombreFichero,
                        ])->toArray()
                    );
                    $tipoSolicitud  = $sol->tipo
                        ?? ($sol->{'3dModelId'} ? 'propia' : ($sol->piezaCatalogoId ? 'catalogo' : 'personalizada'));
                    $modeloNombre   = $sol->threeDModel->nombreModelo ?? '';
                    $modeloExt      = strtoupper($sol->threeDModel->tipo ?? '');
                    $modeloId       = $sol->threeDModel->id ?? '';
                    $colorNombre    = $sol->threeDModel->color->nombre ?? '';
                    $incluyeModelo  = $sol->incluye_modelo_3d;
                    $incluyePieza   = $sol->incluye_pieza;
                    $piezaNombre    = $sol->piezaCatalogo->nombre ?? '';
                    [$tipoLabel, $tipoBadgeClass] = match($tipoSolicitud) {
                        'propia'        => ['Propia', 'badge-info'],
                        'catalogo'      => ['Del Catálogo', 'badge-accent'],
                        default         => ['Personalizada', 'badge-secondary'],
                    };
                @endphp
                <tr
                    class="hover:bg-base-200/50 transition-colors cursor-pointer"
                    onclick="openRequestModal(this)"
                    data-sol-id="{{ $sol->id }}"
                    data-sol-short="{{ substr($sol->id, 24) }}"
                    data-sol-cliente="{{ trim(($sol->user->nombre ?? '') . ' ' . ($sol->user->apellidos ?? '')) }}"
                    data-sol-estado-id="{{ $estadoId }}"
                    data-sol-detalles="{{ $sol->detalles ?? '' }}"
                    data-sol-adjuntos="{{ $adjuntosJson }}"
                    data-sol-tipo="{{ $tipoSolicitud }}"
                    data-sol-modelo-nombre="{{ $modeloNombre }}"
                    data-sol-modelo-ext="{{ $modeloExt }}"
                    data-sol-modelo-id="{{ $modeloId }}"
                    data-sol-color="{{ $colorNombre }}"
                    data-sol-altura-capa="{{ $sol->alturaCapa ?? '' }}"
                    data-sol-porcentaje-relleno="{{ $sol->porcentajeRelleno ?? '' }}"
                    data-sol-patron-relleno="{{ $sol->patronRelleno ?? '' }}"
                    data-sol-incluye-modelo="{{ $incluyeModelo !== null ? ($incluyeModelo ? '1' : '0') : '' }}"
                    data-sol-incluye-pieza="{{ $incluyePieza !== null ? ($incluyePieza ? '1' : '0') : '' }}"
                    data-sol-pieza-nombre="{{ $piezaNombre }}"
                >
                    <td class="font-mono text-xs text-primary">
                        #{{ substr($sol->id, 24) }}
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
                        <span class="badge badge-soft {{ $tipoBadgeClass }} badge-sm">{{ $tipoLabel }}</span>
                    </td>
                    <td>
                        <span class="badge badge-soft {{ $badgeClass }} badge-sm">{{ $estadoNombre ?: 'Sin estado' }}</span>
                    </td>
                    <td class="text-center">
                        <button
                            class="btn btn-ghost btn-sm text-primary hover:text-primary/80"
                            onclick="event.stopPropagation(); openRequestModal(this.closest('tr'))"
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
                    <td colspan="6" class="text-center py-16 text-base-content/50">
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
        <div class="modal-box max-w-2xl bg-base-200 border border-sky-500/30 text-base-content max-h-[90vh] overflow-y-auto">
            <h3 class="text-xl font-semibold mb-1">Editar Solicitud</h3>
            <p id="modal_solicitud_id" class="text-xs font-mono text-primary/70 mb-6"></p>

            <form id="edit_request_form" method="POST">
                @csrf
                @method('PUT')

                {{-- Cliente --}}
                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Cliente</legend>
                    <p id="modal_cliente_nombre" class="text-sm text-base-content px-1 py-1"></p>
                </fieldset>

                {{-- Tipo de solicitud --}}
                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Tipo de solicitud</legend>
                    <div class="px-1 py-1">
                        <span id="modal_tipo_badge" class="badge badge-soft badge-sm"></span>
                    </div>
                </fieldset>

                {{-- Modelo 3D (solo si es propia) --}}
                <fieldset id="modal_modelo_fieldset" class="fieldset mb-4 hidden">
                    <legend class="fieldset-legend text-base-content/60">Modelo 3D</legend>
                    <div class="flex items-center gap-2 px-1 py-1">
                        <span id="modal_modelo_nombre" class="text-sm text-base-content font-medium"></span>
                        <a id="modal_modelo_download_btn"
                           href="#"
                           target="_blank"
                           class="btn btn-ghost btn-xs text-primary hidden ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Descargar
                        </a>
                    </div>
                </fieldset>

                {{-- Pieza del catálogo (solo tipo=catalogo) --}}
                <fieldset id="modal_pieza_fieldset" class="fieldset mb-4 hidden">
                    <legend class="fieldset-legend text-base-content/60">Pieza del Catálogo</legend>
                    <p id="modal_pieza_nombre" class="text-sm text-base-content px-1 py-1"></p>
                </fieldset>

                {{-- Color (solo si tiene) --}}
                <fieldset id="modal_color_fieldset" class="fieldset mb-4 hidden">
                    <legend class="fieldset-legend text-base-content/60">Color</legend>
                    <p id="modal_color_nombre" class="text-sm text-base-content px-1 py-1"></p>
                </fieldset>

                {{-- ¿Qué incluye? (solo tipo=personalizada) --}}
                <fieldset id="modal_incluye_fieldset" class="fieldset mb-4 hidden">
                    <legend class="fieldset-legend text-base-content/60">¿Qué incluye?</legend>
                    <div class="px-1 py-1 space-y-1 text-sm text-base-content">
                        <p><span class="font-medium">Modelo 3D: </span><span id="modal_incluye_modelo"></span></p>
                        <p><span class="font-medium">Pieza impresa: </span><span id="modal_incluye_pieza"></span></p>
                    </div>
                </fieldset>

                {{-- Configuración de impresión (solo si es propia) --}}
                <fieldset id="modal_config_fieldset" class="fieldset mb-4 hidden">
                    <legend class="fieldset-legend text-base-content/60">Configuración de impresión</legend>
                    <div class="grid grid-cols-3 gap-4 px-1 py-2">
                        <div>
                            <label for="modal_altura_capa" class="text-xs text-base-content/50 mb-1 block">Altura de capa (mm)</label>
                            <input type="number" id="modal_altura_capa" name="altura_capa"
                                   min="0.05" max="1.0" step="0.05"
                                   class="input input-bordered input-sm w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400" />
                        </div>
                        <div>
                            <label for="modal_porcentaje_relleno" class="text-xs text-base-content/50 mb-1 block">Relleno (%)</label>
                            <input type="number" id="modal_porcentaje_relleno" name="porcentaje_relleno"
                                   min="0" max="100" step="5"
                                   class="input input-bordered input-sm w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400" />
                        </div>
                        <div>
                            <label for="modal_patron_relleno" class="text-xs text-base-content/50 mb-1 block">Patrón de relleno</label>
                            <select id="modal_patron_relleno" name="patron_relleno"
                                    class="select select-bordered select-sm w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400">
                                <option value="">— Sin especificar —</option>
                                <option value="rejilla">Rejilla</option>
                                <option value="giroide">Giroide</option>
                                <option value="cubico">Cúbico</option>
                                <option value="panal_de_abeja">Panal de abeja</option>
                                <option value="panal_de_abeja_3d">Panal 3D</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                {{-- Estado --}}
                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Estado</legend>
                    <select id="modal_estado" name="estado_id"
                            class="select select-bordered w-full bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 @error('estado_id') border-error @enderror">
                        @foreach ($estados as $estado)
                        <option value="{{ $estado->id }}">{{ $estado->nombreEstado }}</option>
                        @endforeach
                    </select>
                    @error('estado_id') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </fieldset>

                {{-- Notas / Detalles --}}
                <fieldset class="fieldset mb-4">
                    <legend class="fieldset-legend text-base-content/60">Notas / Detalles</legend>
                    <textarea id="modal_detalles" name="detalles"
                              class="textarea textarea-bordered w-full h-28 bg-base-300 border-sky-500/30 text-base-content focus:border-sky-400 resize-none @error('detalles') @enderror"
                              placeholder="Detalles adicionales..."></textarea>
                    @error('detalles') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </fieldset>

                {{-- Archivos adjuntos --}}
                <fieldset id="modal_adjuntos_fieldset" class="fieldset mb-4 hidden">
                    <legend class="fieldset-legend text-base-content/60">Archivos adjuntos</legend>
                    <ul id="modal_adjuntos_list" class="space-y-1 mt-1"></ul>
                </fieldset>

                <div class="modal-action gap-3">
                    <button type="button" onclick="edit_request_modal.close()"
                            class="btn btn-ghost border-base-300 text-base-content/60">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button></button>
        </form>
    </dialog>

    <script>
        const downloadBaseUrl      = '{{ route('admin.adjunto.download', ['adjunto' => '__ADJUNTO_ID__']) }}';
        const downloadModelBaseUrl = '{{ route('admin.model.download', ['model' => '__MODEL_ID__']) }}';

        const PATRON_LABELS = {
            'rejilla':          'Rejilla',
            'giroide':          'Giroide',
            'cubico':           'Cúbico',
            'panal_de_abeja':   'Panal de abeja',
            'panal_de_abeja_3d':'Panal 3D',
        };

        function openRequestModal(btn) {
            const id                 = btn.dataset.solId;
            const shortId            = btn.dataset.solShort;
            const cliente            = btn.dataset.solCliente;
            const estadoId           = btn.dataset.solEstadoId;
            const detalles           = btn.dataset.solDetalles;
            const adjuntos           = JSON.parse(btn.dataset.solAdjuntos || '[]');
            const tipo               = btn.dataset.solTipo;
            const modeloNombre       = btn.dataset.solModeloNombre;
            const modeloExt          = btn.dataset.solModeloExt;
            const modeloId           = btn.dataset.solModeloId;
            const colorNombre        = btn.dataset.solColor;
            const alturaCapa         = btn.dataset.solAlturaCapa;
            const porcentajeRelleno  = btn.dataset.solPorcentajeRelleno;
            const patronRelleno      = btn.dataset.solPatronRelleno;
            const incluyeModelo      = btn.dataset.solIncluyeModelo;
            const incluyePieza       = btn.dataset.solIncluyePieza;
            const piezaNombre        = btn.dataset.solPiezaNombre;

            // Cabecera
            document.getElementById('modal_solicitud_id').textContent   = '#' + shortId;
            document.getElementById('modal_cliente_nombre').textContent = cliente;
            document.getElementById('modal_detalles').value             = detalles;
            document.getElementById('modal_estado').value               = estadoId;

            const form = document.getElementById('edit_request_form');
            form.action = '/admin/requests/' + id;

            // Tipo de solicitud
            const tipoBadge = document.getElementById('modal_tipo_badge');
            if (tipo === 'propia') {
                tipoBadge.textContent = 'Pieza propia';
                tipoBadge.className   = 'badge badge-soft badge-info badge-sm';
            } else if (tipo === 'catalogo') {
                tipoBadge.textContent = 'Del Catálogo';
                tipoBadge.className   = 'badge badge-soft badge-accent badge-sm';
            } else {
                tipoBadge.textContent = 'Personalizada';
                tipoBadge.className   = 'badge badge-soft badge-secondary badge-sm';
            }

            // Modelo 3D (solo propia)
            const modeloFieldset = document.getElementById('modal_modelo_fieldset');
            if (modeloNombre) {
                document.getElementById('modal_modelo_nombre').textContent = modeloNombre;

                const dlBtn = document.getElementById('modal_modelo_download_btn');
                if (modeloId) {
                    dlBtn.href = downloadModelBaseUrl.replace('__MODEL_ID__', modeloId);
                    dlBtn.classList.remove('hidden');
                } else {
                    dlBtn.classList.add('hidden');
                }
                modeloFieldset.classList.remove('hidden');
            } else {
                modeloFieldset.classList.add('hidden');
            }

            // Pieza del catálogo
            const piezaFieldset = document.getElementById('modal_pieza_fieldset');
            if (tipo === 'catalogo' && piezaNombre) {
                document.getElementById('modal_pieza_nombre').textContent = piezaNombre;
                piezaFieldset.classList.remove('hidden');
            } else {
                piezaFieldset.classList.add('hidden');
            }

            // Color
            const colorFieldset = document.getElementById('modal_color_fieldset');
            if (colorNombre) {
                document.getElementById('modal_color_nombre').textContent = colorNombre;
                colorFieldset.classList.remove('hidden');
            } else {
                colorFieldset.classList.add('hidden');
            }

            // ¿Qué incluye? (solo personalizada)
            const incluyeFieldset = document.getElementById('modal_incluye_fieldset');
            if (tipo === 'personalizada' && (incluyeModelo !== '' || incluyePieza !== '')) {
                document.getElementById('modal_incluye_modelo').textContent =
                    incluyeModelo === '1' ? 'Sí, incluir' : 'No';
                document.getElementById('modal_incluye_pieza').textContent =
                    incluyePieza === '1' ? 'Sí, incluir en entrega' : 'No';
                incluyeFieldset.classList.remove('hidden');
            } else {
                incluyeFieldset.classList.add('hidden');
            }

            // Configuración de impresión (editable, solo para pieza propia)
            const configFieldset = document.getElementById('modal_config_fieldset');
            if (tipo === 'propia') {
                document.getElementById('modal_altura_capa').value        = alturaCapa        || '';
                document.getElementById('modal_porcentaje_relleno').value = porcentajeRelleno || '';
                document.getElementById('modal_patron_relleno').value     = patronRelleno     || '';
                configFieldset.classList.remove('hidden');
            } else {
                configFieldset.classList.add('hidden');
            }

            // Adjuntos
            const adjFieldset = document.getElementById('modal_adjuntos_fieldset');
            const adjList     = document.getElementById('modal_adjuntos_list');
            adjList.innerHTML = '';

            if (adjuntos.length > 0) {
                adjFieldset.classList.remove('hidden');
                adjuntos.forEach(function (adj) {
                    const url = downloadBaseUrl.replace('__ADJUNTO_ID__', adj.id);
                    const li  = document.createElement('li');
                    li.innerHTML = `
                        <a href="${url}" target="_blank"
                           class="flex items-center gap-2 text-sm text-primary hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            ${adj.nombre}
                        </a>`;
                    adjList.appendChild(li);
                });
            } else {
                adjFieldset.classList.add('hidden');
            }

            document.getElementById('edit_request_modal').showModal();
        }
    </script>

</x-layouts::admin>
