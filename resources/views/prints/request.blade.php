<x-layouts::home :title="'Solicitar una Pieza'">
        <main class="grow container mx-auto px-4 py-12">
            <div class="text-center mb-16">
                <h1 class="text-5xl font-bold mb-4">Solicitar una Pieza</h1>
                <p class="text-xl text-gray-600">Elige cómo quieres que sea tu pieza</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-12">
                <!-- Pieza Propia -->
                <a href="{{ route('prints.own') }}" class="group">
                    <div
                        class="card bg-base-100 border border-base-300 hover:border-primary hover:shadow-xl transition-all duration-300 h-full">
                        <div class="card-body items-center text-center p-8">
                            <div
                                class="w-24 h-24 bg-base-200 rounded-full flex items-center justify-center mb-4 group-hover:bg-primary transition-colors">
                                <svg class="w-12 h-12 text-primary group-hover:text-white" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold">Tu Modelo 3D</h2>
                            <p class="text-gray-600 mt-2">Sube tu propio modelo 3D y nosotros lo imprimimos</p>
                            <div class="card-actions justify-center mt-6">
                                <button class="btn btn-primary">Continuar</button>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Pieza Personalizada -->
                <a href="{{ route('prints.custom') }}" class="group">
                    <div
                        class="card bg-base-100 border border-base-300 hover:border-primary hover:shadow-xl transition-all duration-300 h-full">
                        <div class="card-body items-center text-center p-8">
                            <div
                                class="w-24 h-24 bg-base-200 rounded-full flex items-center justify-center mb-4 group-hover:bg-primary transition-colors">
                                <svg class="w-12 h-12 text-primary group-hover:text-white" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold">Diseño Personalizado</h2>
                            <p class="text-gray-600 mt-2">Cuéntanos tu idea y nuestros diseñadores crean el modelo
                                perfecto</p>
                            <div class="card-actions justify-center mt-6">
                                <button class="btn btn-primary">Continuar</button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Catálogo -->
            <div class="mt-16 pt-8 border-t">
                <h3 class="text-2xl font-bold text-center mb-8">O busca en nuestro catálogo</h3>
                <div class="text-center">
                    <a href="{{ route('prints.catalog') }}" class="btn btn-outline btn-lg">
                        Ver Catálogo de Piezas
                    </a>
                </div>
            </div>
        </main>
</x-layouts::home>
