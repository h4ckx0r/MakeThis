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
                        @endphp
                        <div class="flex flex-col rounded-[10px] border border-base-300 bg-base-200 p-5 gap-3">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs text-primary">#{{ substr($sol->id, 0, 8) }}</span>
                                <span class="badge badge-soft {{ $badgeClass }} badge-sm">{{ $estadoLabel }}</span>
                            </div>
                            <h3 class="text-lg font-medium truncate">
                                {{ $sol->threeDModel->nombreModelo ?? 'Modelo sin nombre' }}
                            </h3>
                            <span class="text-xs text-base-content/50">
                                {{ $sol->created_at->format('d/m/Y') }}
                            </span>
                        </div>
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
</body>

</html>
