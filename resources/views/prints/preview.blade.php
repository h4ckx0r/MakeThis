<x-layouts::home :title="'Preview de Solicitud'">
        <main class="grow container mx-auto px-4 py-12">
            <div class="mb-12">
                <h1 class="text-4xl font-bold mb-2">Resumen de tu Solicitud</h1>
                <p class="text-base-content/60">Verifica que todos los datos sean correctos antes de confirmar</p>
            </div>

            <div class="max-w-2xl mx-auto space-y-8">
                <!-- Propiedades -->
                <div class="space-y-6">
                    <!-- Tipo de Pieza -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold uppercase tracking-wide text-base-content/60">Tipo de
                            Pieza</label>
                        <div class="bg-base-200 rounded-lg p-4">
                            <p class="text-lg font-semibold capitalize">
                                @if(session('preview')['tipo'] === 'propia')
                                Tu Modelo 3D
                                @else
                                Diseño Personalizado
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Material -->
                    <div class="space-y-2">
                        <label
                            class="block text-sm font-semibold uppercase tracking-wide text-base-content/60">Material</label>
                        <div class="bg-base-200 rounded-lg p-4">
                            <p class="text-lg font-semibold">{{ session('preview')['material'] }}</p>
                        </div>
                    </div>

                    <!-- Color -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold uppercase tracking-wide text-base-content/60">Color</label>
                        <div class="bg-base-200 rounded-lg p-4">
                            <p class="text-lg font-semibold">{{ session('preview')['color'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Indicaciones -->
                @if(session('preview')['indicaciones'] ?? false)
                <div>
                    <label class="block text-sm font-semibold uppercase tracking-wide text-base-content/60 mb-2">Indicaciones
                        Especiales</label>
                    <div class="bg-base-200 rounded-lg p-4">
                        <p class="whitespace-pre-line">{{ session('preview')['indicaciones'] }}</p>
                    </div>
                </div>
                @endif

                <!-- Botones de Acción -->
                <div class="flex gap-4 pt-8">
                    <a href="javascript:history.back()" class="btn btn-outline flex-1">
                        ← Volver a editar
                    </a>
                    <form action="{{ route('piezas.store') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="btn btn-primary w-full">
                            Solicitar Pieza
                        </button>
                    </form>
                </div>

                <!-- Nota -->
                <div class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="stroke-current shrink-0 w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Tu solicitud ha sido guardada. Te contactaremos pronto con más detalles sobre el presupuesto y
                        el tiempo de entrega.</span>
                </div>
            </div>
        </main>

</x-layouts::home>
