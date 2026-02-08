<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="bg-base-100 text-base-content">
    <div class="min-h-screen flex flex-col">
        <x-home-navbar />

        <main class="flex-grow container mx-auto px-4 py-12">
        <div class="mb-12">
            <h1 class="text-4xl font-bold mb-2">Pieza Personalizada</h1>
            <p class="text-gray-600">Cuéntanos tu idea y nuestros diseñadores crearán el modelo perfecto para ti</p>
        </div>

        <form action="{{ route('piezas.preview') }}" method="POST" class="space-y-8">
            @csrf
            <input type="hidden" name="tipo" value="personalizada">

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Columna Izquierda: Drag & Drop de Imágenes -->
                <div>
                    <label class="block text-lg font-semibold mb-4">Imágenes de Referencia</label>
                    @livewire('piezas.file-uploader', ['tipo' => 'imagen'])
                </div>

                <!-- Columna Derecha: Formulario -->
                <div class="space-y-6">
                    <!-- Material -->
                    <div>
                        <label for="material" class="block text-sm font-semibold mb-2">Material Preferido</label>
                        <select id="material" name="material" class="select select-bordered w-full bg-base-200" required>
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
                        <label for="color" class="block text-sm font-semibold mb-2">Color Preferido</label>
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

                    <!-- Opciones -->
                    <div class="space-y-3">
                        <h3 class="font-semibold">¿Qué incluir?</h3>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">Incluir modelo 3D (para futuras impresiones)</span>
                                <input type="checkbox" name="incluye_modelo_3d" class="checkbox" />
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">Incluir pieza impresa en la entrega</span>
                                <input type="checkbox" name="incluye_pieza" class="checkbox" checked />
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Descripción Detallada -->
            <div>
                <label for="indicaciones" class="block text-sm font-semibold mb-2">Descripción de tu Idea</label>
                <textarea id="indicaciones" name="indicaciones" rows="8"
                          class="textarea textarea-bordered w-full bg-base-200"
                          placeholder="Describe detalladamente tu idea:&#10;- ¿Qué es lo que necesitas?&#10;- ¿Cuáles son las dimensiones aproximadas?&#10;- ¿Qué función cumplirá?&#10;- ¿Hay algún requisito especial de resistencia o flexibilidad?&#10;- ¿Algún otro detalle importante?"
                          required></textarea>
            </div>

            <!-- Botones -->
            <div class="flex gap-4 pt-6">
                <a href="{{ route('piezas.solicitar') }}" class="btn btn-outline">Cancelar</a>
                <button type="submit" class="btn btn-primary flex-1">Vista Previa</button>
            </div>
        </form>
    </main>

    <x-home-footer />
    </div>
</body>
</html>
