@php use Carbon\Carbon;$title = 'Reportes'; @endphp

<x-layouts::admin :title="$title">

    {{-- Page Title --}}
    <div class="mb-8">
        <h1 class="text-3xl font-semibold tracking-wide text-base-content">Reportes</h1>
        <p class="text-sm text-base-content/50 mt-1">Resumen general de actividad del sistema</p>
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
