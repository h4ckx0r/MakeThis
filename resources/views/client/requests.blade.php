<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="bg-base-100 text-base-content">
    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        <livewire:navbar />

        {{-- Sección de perfil y animación --}}
        <section class="border-b border-base-300 pt-28">
            <div class="mx-auto max-w-7xl px-6 py-12">
                <div class="flex items-center justify-between gap-8">
                    {{-- Avatar y nombre del usuario --}}
                    <div class="flex-shrink-0 flex flex-col items-center gap-3">
                        <flux:avatar :initials="auth()->user()->initials()" circle size="xl" class="bg-celeste! text-black! w-[200px]! h-[200px]! text-6xl! after:hidden!" />
                        <div class="flex items-center justify-center rounded-[10px] border border-base-300 px-4 h-[27px] overflow-hidden">
                            <span class="text-[14px] font-normal whitespace-nowrap">{{ '@' . str_replace(' ', '', auth()->user()->nombre) }}</span>
                        </div>
                    </div>

                    {{-- Animación 3D del index --}}
                    <div class="flex-1">
                        <div class="scene">
                            @php
                                $data = [
                                    '30640195',
                                    '30415869',
                                    '30620861',
                                    '9242916',
                                    '35595049',
                                    '33800640',
                                    '17509941',
                                    '14158951',
                                    '3861437',
                                    '19278850',
                                    '31137405',
                                    '7869233',
                                ];
                                $n = count($data);
                            @endphp
                            <div class="a3d -mt-10" style="--n: {{ $n }}">
                                @foreach($data as $i => $id)
                                    <img class="landing-card"
                                         src="https://images.pexels.com/photos/{{ $id }}/pexels-photo-{{ $id }}.jpeg?auto=compress&cs=tinysrgb&h=350"
                                         style="--i: {{ $i }}"
                                         alt="Pieza impresa en 3d de muestra">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Contenido principal - Solicitudes --}}
        <main class="flex-1 border-b border-base-300">
            <div class="mx-auto max-w-7xl px-6 py-8">
                {{-- Título --}}
                <h2 class="text-[32px] font-semibold mb-8">
                    SOLICITUDES DE {{ strtoupper(auth()->user()->nombre) }}
                </h2>

                {{-- Grid de solicitudes --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
                            $adjuntosData = $sol->adjuntos->map(fn($a) => [
                                'nombre' => $a->nombreFichero,
                                'url' => \Illuminate\Support\Facades\Storage::url($a->fichero),
                            ])->toArray();
                        @endphp
                        <button
                            onclick="openSolicitudModal(this)"
                            class="flex flex-col rounded-[10px] border border-base-300 bg-base-200 p-5 gap-3 cursor-pointer hover:border-primary/40 hover:bg-base-300/50 transition-colors text-left w-full"
                            data-id="{{ substr($sol->id, 24) }}"
                            data-estado-nombre="{{ $estadoNombre }}"
                            data-estado-label="{{ $estadoLabel }}"
                            data-badge-class="{{ $badgeClass }}"
                            data-nombre-modelo="{{ $sol->threeDModel->nombreModelo ?? 'Modelo sin nombre' }}"
                            data-color="{{ $sol->threeDModel->color->nombre ?? '' }}"
                            data-altura-capa="{{ $sol->alturaCapa ?? '' }}"
                            data-porcentaje-relleno="{{ $sol->porcentajeRelleno ?? '' }}"
                            data-patron-relleno="{{ $sol->patronRelleno ?? '' }}"
                            data-detalles="{{ $sol->detalles ?? '' }}"
                            data-fecha="{{ $sol->created_at->format('d/m/Y') }}"
                            data-adjuntos='@json($adjuntosData)'
                        >
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs text-primary">#{{ substr($sol->id, 24) }}</span>
                                <span class="badge badge-soft {{ $badgeClass }} badge-sm">{{ $estadoLabel }}</span>
                            </div>
                            <h3 class="text-lg font-medium truncate">
                                {{ $sol->threeDModel->nombreModelo ?? 'Modelo sin nombre' }}
                            </h3>
                            <span class="text-xs text-base-content/50">
                                {{ $sol->created_at->format('d/m/Y') }}
                            </span>
                        </button>
                    @empty
                        <div class="col-span-full flex flex-col items-center justify-center py-16 text-base-content/50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>No tienes solicitudes todavía</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>

        {{-- Footer --}}
        <livewire:footer />
    </div>
    @fluxScripts

    {{-- Modal de detalle de solicitud --}}
    <dialog id="solicitud-modal" class="modal">
        <div class="modal-box max-w-lg">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>

            <h3 class="font-semibold text-lg mb-1">
                Solicitud <span id="modal-id" class="font-mono text-primary"></span>
            </h3>
            <div class="flex items-center gap-3 mb-4">
                <span class="text-sm text-base-content/50" id="modal-fecha"></span>
                <span id="modal-badge" class="badge badge-soft badge-sm"></span>
            </div>

            <div class="divider my-2"></div>

            <div class="space-y-4">
                <div>
                    <p class="text-xs text-base-content/50 uppercase tracking-wide mb-1">Modelo</p>
                    <p class="font-medium" id="modal-nombre-modelo"></p>
                </div>

                <div id="modal-color-container">
                    <p class="text-xs text-base-content/50 uppercase tracking-wide mb-1">Color</p>
                    <p id="modal-color"></p>
                </div>

                <div id="modal-config-container" class="grid grid-cols-3 gap-3">
                    <div>
                        <p class="text-xs text-base-content/50 uppercase tracking-wide mb-1">Altura de capa</p>
                        <p id="modal-altura-capa" class="text-sm"></p>
                    </div>
                    <div>
                        <p class="text-xs text-base-content/50 uppercase tracking-wide mb-1">Relleno</p>
                        <p id="modal-porcentaje-relleno" class="text-sm"></p>
                    </div>
                    <div>
                        <p class="text-xs text-base-content/50 uppercase tracking-wide mb-1">Patrón</p>
                        <p id="modal-patron-relleno" class="text-sm"></p>
                    </div>
                </div>

                <div id="modal-detalles-container">
                    <p class="text-xs text-base-content/50 uppercase tracking-wide mb-1">Indicaciones</p>
                    <p class="text-sm" id="modal-detalles"></p>
                </div>

                <div id="modal-adjuntos-container">
                    <p class="text-xs text-base-content/50 uppercase tracking-wide mb-1">Adjuntos</p>
                    <ul class="space-y-1" id="modal-adjuntos-list"></ul>
                </div>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop"><button>cerrar</button></form>
    </dialog>

    <script>
        function openSolicitudModal(btn) {
            const modal = document.getElementById('solicitud-modal');

            document.getElementById('modal-id').textContent = '#' + btn.dataset.id;
            document.getElementById('modal-fecha').textContent = btn.dataset.fecha;

            const badge = document.getElementById('modal-badge');
            badge.textContent = btn.dataset.estadoLabel;
            badge.className = 'badge badge-soft badge-sm ' + btn.dataset.badgeClass;

            document.getElementById('modal-nombre-modelo').textContent = btn.dataset.nombreModelo;

            const colorContainer = document.getElementById('modal-color-container');
            if (btn.dataset.color) {
                document.getElementById('modal-color').textContent = btn.dataset.color;
                colorContainer.classList.remove('hidden');
            } else {
                colorContainer.classList.add('hidden');
            }

            const configContainer = document.getElementById('modal-config-container');
            if (btn.dataset.alturaCapa || btn.dataset.porcentajeRelleno || btn.dataset.patronRelleno) {
                document.getElementById('modal-altura-capa').textContent = btn.dataset.alturaCapa || '—';
                document.getElementById('modal-porcentaje-relleno').textContent =
                    btn.dataset.porcentajeRelleno ? btn.dataset.porcentajeRelleno + '%' : '—';
                document.getElementById('modal-patron-relleno').textContent = btn.dataset.patronRelleno || '—';
                configContainer.classList.remove('hidden');
            } else {
                configContainer.classList.add('hidden');
            }

            const detallesContainer = document.getElementById('modal-detalles-container');
            if (btn.dataset.detalles) {
                document.getElementById('modal-detalles').textContent = btn.dataset.detalles;
                detallesContainer.classList.remove('hidden');
            } else {
                detallesContainer.classList.add('hidden');
            }

            const adjuntosContainer = document.getElementById('modal-adjuntos-container');
            const adjuntosList = document.getElementById('modal-adjuntos-list');
            adjuntosList.innerHTML = '';
            try {
                const adjuntos = JSON.parse(btn.dataset.adjuntos);
                if (adjuntos && adjuntos.length > 0) {
                    adjuntos.forEach(a => {
                        const li = document.createElement('li');
                        const link = document.createElement('a');
                        link.href = a.url;
                        link.target = '_blank';
                        link.className = 'link link-primary text-sm';
                        link.textContent = a.nombre;
                        li.appendChild(link);
                        adjuntosList.appendChild(li);
                    });
                    adjuntosContainer.classList.remove('hidden');
                } else {
                    adjuntosContainer.classList.add('hidden');
                }
            } catch {
                adjuntosContainer.classList.add('hidden');
            }

            modal.showModal();
        }
    </script>
</body>

</html>
