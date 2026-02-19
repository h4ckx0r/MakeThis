<x-layouts::home :title="'Sube tu Modelo 3D'">
        <main class="flex-grow container mx-auto px-4 py-12">
            <div class="mb-12">
                <h1 class="text-4xl font-bold mb-2">Sube tu Modelo 3D</h1>
                <p class="text-base-content/60">Proporciona los detalles de tu pieza para que pueda ser impresa correctamente
                </p>
            </div>

            <form action="{{ route('prints.preview') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="tipo" value="propia">

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Columna Izquierda: Drag & Drop -->
                    <div>
                        <label class="block text-lg font-semibold mb-4">Archivo 3D</label>
                        @livewire('piezas.file-uploader', ['tipo' => '3d'])
                    </div>

                    <!-- Columna Derecha: Formulario -->
                    <div class="space-y-6">
                        <!-- Material -->
                        <div>
                            <label for="material" class="block text-sm font-semibold mb-2">Material</label>
                            <select id="material" name="material" class="select select-bordered w-full bg-base-200"
                                required>
                                <option value="">Selecciona un material</option>
                                <option value="PLA">PLA</option>
                                <option value="ABS">ABS</option>
                                <option value="PETG">PETG</option>
                                <option value="TPU">TPU</option>
                                <option value="Nylon">Nylon</option>
                            </select>
                            @error('material')
                            <span class="text-error text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Color -->
                        <div>
                            <label for="color" class="block text-sm font-semibold mb-2">Color</label>
                            <select id="color" name="color" class="select select-bordered w-full bg-base-200" required>
                                <option value="">Selecciona un color</option>
                                <option value="Blanco">Blanco</option>
                                <option value="Negro">Negro</option>
                                <option value="Rojo">Rojo</option>
                                <option value="Azul">Azul</option>
                                <option value="Verde">Verde</option>
                                <option value="Amarillo">Amarillo</option>
                                <option value="Gris">Gris</option>
                                <option value="Naranja">Naranja</option>
                            </select>
                            @error('color')
                            <span class="text-error text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Configuración Recomendada -->
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text font-semibold">Usar configuración recomendada por
                                    expertos</span>
                                <input type="checkbox" id="configRecomendada" class="checkbox" checked />
                            </label>
                        </div>

                        <!-- Configuración Avanzada (Colapsable) -->
                        <div id="configAvanzada" class="space-y-4 pt-4 border-t">
                            <h3 class="font-semibold">Configuración Avanzada</h3>

                            <div>
                                <label for="altura_capa" class="block text-sm font-semibold mb-2">Altura de Capa
                                    (mm)</label>
                                <input type="number" id="altura_capa" name="altura_capa" step="0.1" min="0.1"
                                    class="input input-bordered w-full bg-base-200" placeholder="0.2" />
                            </div>

                            <div>
                                <label for="porcentaje_relleno" class="block text-sm font-semibold mb-2">Porcentaje de
                                    Relleno (%)</label>
                                <input type="number" id="porcentaje_relleno" name="porcentaje_relleno" min="0" max="100"
                                    class="input input-bordered w-full bg-base-200" placeholder="20" />
                            </div>

                            <div>
                                <label for="patron_relleno" class="block text-sm font-semibold mb-2">Patrón de
                                    Relleno</label>
                                <select id="patron_relleno" name="patron_relleno"
                                    class="select select-bordered w-full bg-base-200">
                                    <option value="">Selecciona un patrón</option>
                                    <option value="linear">Lineal</option>
                                    <option value="grid">Cuadrícula</option>
                                    <option value="gyroid">Gyroid</option>
                                    <option value="honeycomb">Panal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Indicaciones -->
                <div>
                    <label for="indicaciones" class="block text-sm font-semibold mb-2">Indicaciones Especiales</label>
                    <textarea id="indicaciones" name="indicaciones" rows="6"
                        class="textarea textarea-bordered w-full bg-base-200"
                        placeholder="Añade cualquier instrucción especial para la impresión de tu pieza..."></textarea>
                </div>

                <!-- Botones -->
                <div class="flex gap-4 pt-6">
                    <a href="{{ route('prints.request') }}" class="btn btn-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary flex-1">Vista Previa</button>
                </div>
            </form>
        </main>
    <script>
        document.getElementById('configRecomendada').addEventListener('change', function () {
            const configAvanzada = document.getElementById('configAvanzada');
            configAvanzada.style.display = this.checked ? 'none' : 'block';
        });

        // Mostrar/ocultar configuración avanzada al inicio
        document.getElementById('configAvanzada').style.display = 'none';
    </script>
</x-layouts::home>
