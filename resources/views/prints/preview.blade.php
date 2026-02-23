<x-layouts::home :title="'Resumen de Solicitud'">
    @php $preview = session('preview'); @endphp

    <main class="grow container mx-auto px-4 py-12">
        <div class="mb-12">
            <h1 class="text-4xl font-bold mb-2">Resumen de tu Solicitud</h1>
            <p class="text-base-content/60">Verifica que todos los datos sean correctos antes de confirmar</p>
        </div>

        <div class="max-w-2xl mx-auto space-y-6">

            <!-- Tipo -->
            <div class="space-y-2">
                <label class="block text-sm font-semibold uppercase tracking-wide text-base-content/60">Tipo de Pieza</label>
                <div class="bg-base-200 rounded-lg p-4">
                    <p class="text-lg font-semibold">
                        {{ $preview['tipo'] === 'propia' ? 'Tu Modelo 3D' : 'Diseño Personalizado' }}
                    </p>
                </div>
            </div>

            <!-- Archivo subido -->
            @if(!empty($preview['archivo_nombre']))
            <div class="space-y-2">
                <label class="block text-sm font-semibold uppercase tracking-wide text-base-content/60">
                    {{ $preview['tipo'] === 'propia' ? 'Modelo 3D' : 'Imagen de Referencia' }}
                </label>
                <div class="bg-base-200 rounded-lg p-4 flex items-center gap-3">
                    <svg class="w-8 h-8 text-success flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="font-medium break-all">{{ $preview['archivo_nombre'] }}</p>
                </div>
            </div>
            @endif

            <!-- Material -->
            <div class="space-y-2">
                <label class="block text-sm font-semibold uppercase tracking-wide text-base-content/60">Material</label>
                <div class="bg-base-200 rounded-lg p-4">
                    <p class="text-lg font-semibold">{{ $preview['materialNombre'] }}</p>
                </div>
            </div>

            <!-- Color -->
            <div class="space-y-2">
                <label class="block text-sm font-semibold uppercase tracking-wide text-base-content/60">Color</label>
                <div class="bg-base-200 rounded-lg p-4 flex items-center gap-3">
                    @if(!empty($preview['colorHex']))
                    <div class="w-8 h-8 rounded-full border border-base-300 flex-shrink-0"
                         style="background-color: #{{ $preview['colorHex'] }}"></div>
                    @endif
                    <p class="text-lg font-semibold">{{ $preview['colorNombre'] }}</p>
                </div>
            </div>

            <!-- Configuración avanzada (solo propia) -->
            @if($preview['tipo'] === 'propia' && (!empty($preview['altura_capa']) || !empty($preview['porcentaje_relleno'])))
            <div class="space-y-2">
                <label class="block text-sm font-semibold uppercase tracking-wide text-base-content/60">Configuración de Impresión</label>
                <div class="bg-base-200 rounded-lg p-4 space-y-1">
                    @if(!empty($preview['altura_capa']))
                        <p><span class="font-medium">Altura de capa:</span> {{ $preview['altura_capa'] }} mm</p>
                    @endif
                    @if(!empty($preview['porcentaje_relleno']))
                        <p><span class="font-medium">Relleno:</span> {{ $preview['porcentaje_relleno'] }}%</p>
                    @endif
                    @if(!empty($preview['patron_relleno']))
                        <p><span class="font-medium">Patrón:</span> {{ ucfirst($preview['patron_relleno']) }}</p>
                    @endif
                </div>
            </div>
            @endif

            <!-- Indicaciones -->
            @if(!empty($preview['indicaciones']))
            <div class="space-y-2">
                <label class="block text-sm font-semibold uppercase tracking-wide text-base-content/60">
                    {{ $preview['tipo'] === 'propia' ? 'Indicaciones Especiales' : 'Descripción de la Idea' }}
                </label>
                <div class="bg-base-200 rounded-lg p-4">
                    <p class="whitespace-pre-line">{{ $preview['indicaciones'] }}</p>
                </div>
            </div>
            @endif

            <!-- Botones de Acción -->
            <div class="flex gap-4 pt-4">
                <a href="javascript:history.back()" class="btn btn-outline flex-1">
                    ← Volver a editar
                </a>
                @auth
                <form action="{{ route('prints.store') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="btn btn-primary w-full">
                        Confirmar Solicitud
                    </button>
                </form>
                @else
                <a href="{{ route('auth.login') }}" class="btn btn-primary flex-1">
                    Inicia sesión para confirmar
                </a>
                @endauth
            </div>

            <!-- Nota informativa -->
            <div class="alert alert-info">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     class="stroke-current shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Una vez confirmada tu solicitud, te contactaremos con el presupuesto y el tiempo de entrega.</span>
            </div>
        </div>
    </main>
</x-layouts::home>
