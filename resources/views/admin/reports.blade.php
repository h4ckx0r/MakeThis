@php use Carbon\Carbon;$title = 'Reportes'; @endphp

<x-layouts::admin :title="$title">

    {{-- Page Title + API Key Button --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-semibold tracking-wide text-base-content">Reportes</h1>
            <p class="text-sm text-base-content/50 mt-1">Resumen general de actividad del sistema</p>
        </div>
        <button class="btn btn-ghost btn-sm border-sky-500/30 text-base-content/70"
                onclick="api_key_modal.showModal()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
            </svg>
            Gestionar API Key
        </button>
    </div>

    {{-- Stats Cards --}}
    <div class="overflow-x-auto mb-10">
        <div class="stats stats-horizontal shadow w-full bg-base-200 border border-sky-500/20">

            <div class="stat">
                <div class="stat-figure text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="stat-title text-base-content/60">Total Solicitudes</div>
                <div class="stat-value text-base-content">{{ $totalSolicitudes }}</div>
                <div class="stat-desc text-base-content/50">Desde el inicio</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="stat-title text-base-content/60">Completadas</div>
                <div class="stat-value text-success">{{ $solicitudesCompletadas }}</div>
                <div class="stat-desc text-base-content/50">
                    {{ $totalSolicitudes > 0 ? round(($solicitudesCompletadas / $totalSolicitudes) * 100) : 0 }}% del
                    total
                </div>
            </div>

            <div class="stat">
                <div class="stat-figure text-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="stat-title text-base-content/60">Pendientes</div>
                <div class="stat-value text-warning">{{ $solicitudesPendientes }}</div>
                <div class="stat-desc text-base-content/50">En espera de proceso</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div class="stat-title text-base-content/60">Usuarios</div>
                <div class="stat-value text-base-content">{{ $totalUsuarios }}</div>
                <div class="stat-desc text-base-content/50">Registrados en total</div>
            </div>

        </div>
    </div>

    {{-- Date Range Filter --}}
    <form method="GET" action="{{ route('admin.reports') }}" class="mb-8 flex items-end gap-4 flex-wrap">
        <div class="flex flex-col gap-1">
            <label class="label label-text text-base-content/60 text-xs">Desde</label>
            <input type="date" name="fecha_desde"
                   value="{{ request('fecha_desde') }}"
                   class="input input-bordered bg-base-200 border-sky-500/30 text-base-content focus:border-sky-400 focus:outline-none"/>
        </div>

        <div class="flex flex-col gap-1">
            <label class="label label-text text-base-content/60 text-xs">Hasta</label>
            <input type="date" name="fecha_hasta"
                   value="{{ request('fecha_hasta') }}"
                   class="input input-bordered bg-base-200 border-sky-500/30 text-base-content focus:border-sky-400 focus:outline-none"/>
        </div>

        <button type="submit" class="btn btn-primary btn-sm self-end">
            Aplicar filtro
        </button>

        @if(request('fecha_desde') || request('fecha_hasta'))
            <a href="{{ route('admin.reports') }}"
               class="btn btn-ghost btn-sm border-base-300 text-base-content/60 self-end">
                Limpiar
            </a>
        @endif
    </form>

    {{-- Reports Table --}}
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-medium text-base-content/70">
            Reportes recientes
            @if(request('fecha_desde') || request('fecha_hasta'))
                <span class="text-sm text-base-content/50 ml-2">(filtrado)</span>
            @endif
        </h2>
        <span class="text-sm text-base-content/50">{{ $reportesRecientes->count() }} resultado(s)</span>
    </div>

    <div class="rounded-xl border border-sky-500/20 overflow-hidden">
        <table class="table table-zebra table-pin-rows w-full">
            <thead class="bg-base-300">
            <tr class="text-primary text-sm">
                <th>Título</th>
                <th>Solicitud</th>
                <th>Fecha</th>
                <th>Descripción</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($reportesRecientes as $reporte)
                @php
                    $fechaFormateada = $reporte->fecha
                        ? Carbon::parse($reporte->fecha)->format('d/m/Y')
                        : ($reporte->created_at ? $reporte->created_at->format('d/m/Y') : '');
                    $solicitudRef = $reporte->solicitudId ? substr($reporte->solicitudId, 24) : '';
                    $clienteNombre = $reporte->solicitud?->user?->nombre ?? '';
                @endphp
                <tr
                    class="hover:bg-base-200/50 transition-colors cursor-pointer"
                    onclick="openReporteModal(this)"
                    data-titulo="{{ $reporte->titulo ?? '' }}"
                    data-descripcion="{{ $reporte->descripcion ?? '' }}"
                    data-fecha="{{ $fechaFormateada }}"
                    data-solicitud-id="{{ $solicitudRef }}"
                    data-cliente="{{ $clienteNombre }}"
                >
                    <td class="font-medium text-sm text-base-content">{{ $reporte->titulo ?? '—' }}</td>
                    <td>
                        <span class="font-mono text-xs text-primary">
                            {{ $solicitudRef ? '#' . $solicitudRef : '—' }}
                        </span>
                    </td>
                    <td class="text-sm text-base-content/60">{{ $fechaFormateada ?: '—' }}</td>
                    <td class="text-sm text-base-content/70 max-w-xs">
                        <span class="line-clamp-2">{{ $reporte->descripcion ?? '—' }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-16 text-base-content/50">
                        <div class="flex flex-col items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-base-content/20" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                      d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>No hay reportes disponibles{{ (request('fecha_desde') || request('fecha_hasta')) ? ' en el rango de fechas seleccionado' : '' }}</span>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>


    {{-- Modal de detalle de reporte --}}
    <dialog id="reporte-modal" class="modal">
        <div class="modal-box max-w-lg">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>

            <h3 class="font-semibold text-lg mb-1" id="modal-reporte-titulo"></h3>
            <div class="flex items-center gap-3 mb-4">
                <span class="text-sm text-base-content/50" id="modal-reporte-fecha"></span>
                <span id="modal-reporte-solicitud" class="font-mono text-xs text-primary"></span>
            </div>

            <div id="modal-reporte-cliente-container">
                <p class="text-xs text-base-content/50 uppercase tracking-wide mb-1">Cliente</p>
                <p class="text-sm font-medium mb-4" id="modal-reporte-cliente"></p>
            </div>

            <div class="divider my-2"></div>

            <div>
                <p class="text-xs text-base-content/50 uppercase tracking-wide mb-2">Descripción</p>
                <p class="text-sm whitespace-pre-wrap" id="modal-reporte-descripcion"></p>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop"><button>cerrar</button></form>
    </dialog>

    {{-- ── API KEYS MODAL ────────────────────────────────────────────────── --}}
    <dialog id="api_key_modal" class="modal">
        <div class="modal-box max-w-xl bg-base-200 border border-sky-500/30 text-base-content">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold">Gestionar API Keys</h3>
                <button type="button" onclick="api_key_modal.close()"
                        class="btn btn-ghost btn-sm btn-circle text-base-content/60">✕</button>
            </div>

            {{-- Formulario para crear nueva key --}}
            <div class="bg-base-300 rounded-xl p-4 border border-sky-500/10 mb-5">
                <p class="text-xs text-base-content/50 uppercase tracking-wide mb-3">Nueva API Key</p>
                <div class="flex gap-2">
                    <input
                        id="new-key-nombre"
                        type="text"
                        maxlength="100"
                        placeholder="Nombre de la key (ej. Integración ERP)..."
                        class="input input-sm flex-1 bg-base-200 border-sky-500/30 text-base-content
                               placeholder-base-content/40 focus:border-sky-400 focus:outline-none"
                    />
                    <button type="button" id="generate-btn" onclick="generateApiKey()"
                            class="btn btn-primary btn-sm shrink-0">
                        Generar
                    </button>
                </div>
                <p id="nombre-error" class="text-error text-xs mt-1 hidden">El nombre es obligatorio.</p>
            </div>

            {{-- Zona para mostrar nueva key tras generación --}}
            <div id="new-key-display" class="hidden mb-5">
                <div role="alert" class="alert alert-warning text-sm py-2 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Copia esta key ahora. No se volverá a mostrar.</span>
                </div>
                <div class="flex items-center gap-2 bg-base-300 rounded-lg px-4 py-3 border border-success/30">
                    <code id="new-key-value" class="font-mono text-xs text-success flex-1 break-all"></code>
                    <button type="button" id="copy-btn" onclick="copyNewKey()"
                            class="btn btn-ghost btn-xs text-base-content/60 hover:text-base-content shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        Copiar
                    </button>
                </div>
            </div>

            {{-- Lista de keys existentes --}}
            <div>
                <p class="text-xs text-base-content/50 uppercase tracking-wide mb-3">Keys existentes</p>
                <div id="api-keys-list" class="space-y-2 max-h-64 overflow-y-auto pr-1">
                    @forelse($apiKeys as $key)
                    <div class="flex items-center gap-2 rounded-lg bg-base-300 px-3 py-2.5 border border-sky-500/10"
                         id="api-key-row-{{ $key->id }}">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-base-content truncate">
                                {{ $key->descripcion ?? 'Sin nombre' }}
                            </p>
                            <p class="text-xs text-base-content/40">
                                {{ $key->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <span id="badge-{{ $key->id }}"
                              class="badge badge-soft {{ $key->activa ? 'badge-success' : 'badge-neutral' }} badge-xs shrink-0">
                            {{ $key->activa ? 'Activa' : 'Inactiva' }}
                        </span>
                        <button type="button"
                                id="toggle-btn-{{ $key->id }}"
                                onclick="toggleApiKey('{{ $key->id }}', this)"
                                class="btn btn-ghost btn-xs text-base-content/60 hover:text-base-content shrink-0">
                            {{ $key->activa ? 'Desactivar' : 'Activar' }}
                        </button>
                        <button type="button"
                                onclick="deleteApiKey('{{ $key->id }}')"
                                class="btn btn-ghost btn-xs text-error hover:text-red-400 shrink-0">
                            Eliminar
                        </button>
                    </div>
                    @empty
                    <p id="no-keys-msg" class="text-center text-sm text-base-content/40 py-6">
                        No hay API keys configuradas.
                    </p>
                    @endforelse
                </div>
            </div>

        </div>
        <form method="dialog" class="modal-backdrop"><button>cerrar</button></form>
    </dialog>

    <script>
        const CSRF = '{{ csrf_token() }}';

        async function generateApiKey() {
            const nombreInput = document.getElementById('new-key-nombre');
            const nombre = nombreInput.value.trim();
            const errorEl = document.getElementById('nombre-error');

            if (!nombre) {
                errorEl.classList.remove('hidden');
                nombreInput.focus();
                return;
            }
            errorEl.classList.add('hidden');

            const btn = document.getElementById('generate-btn');
            btn.disabled = true;
            btn.textContent = 'Generando...';

            try {
                const res = await fetch('{{ route("admin.api-key.generate") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json', 'Content-Type': 'application/json' },
                    body: JSON.stringify({ nombre }),
                });
                const data = await res.json();

                if (data.key) {
                    // Mostrar la key generada
                    document.getElementById('new-key-value').textContent = data.key;
                    document.getElementById('new-key-display').classList.remove('hidden');
                    nombreInput.value = '';

                    // Añadir la nueva fila a la lista
                    addKeyToList(data.id, data.nombre, data.created_at);
                }
            } catch {
                alert('Error al generar la key. Inténtalo de nuevo.');
            } finally {
                btn.disabled = false;
                btn.textContent = 'Generar';
            }
        }

        function addKeyToList(id, nombre, createdAt) {
            // Quitar el mensaje de "no hay keys" si existe
            document.getElementById('no-keys-msg')?.remove();

            const list = document.getElementById('api-keys-list');
            const row = document.createElement('div');
            row.className = 'flex items-center gap-2 rounded-lg bg-base-300 px-3 py-2.5 border border-sky-500/10';
            row.id = `api-key-row-${id}`;
            row.innerHTML = `
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-base-content truncate">${escHtml(nombre)}</p>
                    <p class="text-xs text-base-content/40">${createdAt}</p>
                </div>
                <span id="badge-${id}" class="badge badge-soft badge-success badge-xs shrink-0">Activa</span>
                <button type="button" id="toggle-btn-${id}"
                        onclick="toggleApiKey('${id}', this)"
                        class="btn btn-ghost btn-xs text-base-content/60 hover:text-base-content shrink-0">
                    Desactivar
                </button>
                <button type="button"
                        onclick="deleteApiKey('${id}')"
                        class="btn btn-ghost btn-xs text-error hover:text-red-400 shrink-0">
                    Eliminar
                </button>`;
            list.prepend(row);
        }

        async function toggleApiKey(id, btn) {
            btn.disabled = true;
            try {
                const res = await fetch(`/admin/api-key/${id}/toggle`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                });
                const data = await res.json();
                const badge = document.getElementById(`badge-${id}`);
                if (data.activa) {
                    badge.textContent = 'Activa';
                    badge.className = 'badge badge-soft badge-success badge-xs shrink-0';
                    btn.textContent = 'Desactivar';
                } else {
                    badge.textContent = 'Inactiva';
                    badge.className = 'badge badge-soft badge-neutral badge-xs shrink-0';
                    btn.textContent = 'Activar';
                }
            } catch {
                alert('Error al cambiar el estado. Inténtalo de nuevo.');
            } finally {
                btn.disabled = false;
            }
        }

        async function deleteApiKey(id) {
            if (!confirm('¿Eliminar esta API key? Quedará invalidada de inmediato.')) return;
            try {
                await fetch(`/admin/api-key/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                });
                document.getElementById(`api-key-row-${id}`)?.remove();

                // Si la lista quedó vacía, mostrar el mensaje
                const list = document.getElementById('api-keys-list');
                if (!list.querySelector('[id^="api-key-row-"]')) {
                    const msg = document.createElement('p');
                    msg.id = 'no-keys-msg';
                    msg.className = 'text-center text-sm text-base-content/40 py-6';
                    msg.textContent = 'No hay API keys configuradas.';
                    list.appendChild(msg);
                }
            } catch {
                alert('Error al eliminar la key. Inténtalo de nuevo.');
            }
        }

        function copyNewKey() {
            const key = document.getElementById('new-key-value').textContent;
            const btn = document.getElementById('copy-btn');
            navigator.clipboard.writeText(key).then(() => {
                btn.textContent = '¡Copiado!';
                setTimeout(() => {
                    btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg> Copiar`;
                }, 2000);
            });
        }

        function escHtml(str) {
            return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
        }
    </script>

    <script>
        function openReporteModal(row) {
            const modal = document.getElementById('reporte-modal');

            document.getElementById('modal-reporte-titulo').textContent = row.dataset.titulo || '(Sin título)';
            document.getElementById('modal-reporte-fecha').textContent = row.dataset.fecha || '—';

            const solicitudEl = document.getElementById('modal-reporte-solicitud');
            solicitudEl.textContent = row.dataset.solicitudId ? '#' + row.dataset.solicitudId : '';

            const clienteContainer = document.getElementById('modal-reporte-cliente-container');
            if (row.dataset.cliente) {
                document.getElementById('modal-reporte-cliente').textContent = row.dataset.cliente;
                clienteContainer.classList.remove('hidden');
            } else {
                clienteContainer.classList.add('hidden');
            }

            document.getElementById('modal-reporte-descripcion').textContent = row.dataset.descripcion || '—';

            modal.showModal();
        }
    </script>

</x-layouts::admin>
