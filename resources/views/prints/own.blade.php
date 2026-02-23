<x-layouts::home :title="'Sube tu Modelo 3D'">
    <main class="flex-grow container mx-auto px-4 py-12"
          x-data="{
              materialId: '',
              colorId: '',
              archivoPath: '',
              archivoNombre: '',
              usarRecomendada: true,
              materiales: {{ $materiales->map(fn($m) => [
                  'id'      => $m->id,
                  'nombre'  => $m->nombre,
                  'colores' => $m->colores->map(fn($c) => [
                      'id'     => $c->id,
                      'nombre' => $c->nombre,
                      'hex'    => $c->hexColor,
                  ])->values(),
              ])->values()->toJson() }},
              get coloresFiltrados() {
                  const mat = this.materiales.find(m => m.id === this.materialId);
                  return mat ? mat.colores : [];
              }
          }"
          @file-uploaded.window="
              if ($event.detail.tipo === '3d') {
                  archivoPath   = $event.detail.path;
                  archivoNombre = $event.detail.name;
              }
          ">

        <div class="mb-12">
            <h1 class="text-4xl font-bold mb-2">Sube tu Modelo 3D</h1>
            <p class="text-base-content/60">Proporciona los detalles de tu pieza para que pueda ser impresa correctamente</p>
        </div>

        <form action="{{ route('prints.preview.store') }}" method="POST" class="space-y-8">
            @csrf
            <input type="hidden" name="tipo" value="propia">
            <input type="hidden" name="archivo_path"   x-model="archivoPath">
            <input type="hidden" name="archivo_nombre" x-model="archivoNombre">
            <input type="hidden" name="materialId"     x-model="materialId">
            <input type="hidden" name="colorId"        x-model="colorId">

            @if ($errors->any())
            <div class="alert alert-error">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Columna Izquierda: Drag & Drop -->
                <div>
                    <label class="block text-lg font-semibold mb-4">Archivo 3D</label>
                    @livewire('piezas.file-uploader', ['tipo' => '3d'])
                    <p x-show="archivoNombre" class="mt-2 text-sm text-success font-medium"
                       x-text="'Archivo listo: ' + archivoNombre"></p>
                    @error('archivo_path')
                        <span class="text-error text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Columna Derecha: Formulario -->
                <div class="space-y-6">
                    <!-- Material -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Material</label>
                        <select class="select select-bordered w-full bg-base-200"
                                x-model="materialId"
                                @change="colorId = ''"
                                required>
                            <option value="">Selecciona un material</option>
                            <template x-for="mat in materiales" :key="mat.id">
                                <option :value="mat.id" x-text="mat.nombre"></option>
                            </template>
                        </select>
                        @error('materialId')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Color (filtrado por material) -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Color</label>
                        <select class="select select-bordered w-full bg-base-200"
                                x-model="colorId"
                                :disabled="!materialId"
                                required>
                            <option value=""
                                    x-text="materialId ? 'Selecciona un color' : 'Primero selecciona un material'">
                            </option>
                            <template x-for="color in coloresFiltrados" :key="color.id">
                                <option :value="color.id" x-text="color.nombre"></option>
                            </template>
                        </select>
                        @error('colorId')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Configuración Recomendada -->
                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text font-semibold">Usar configuración recomendada por expertos</span>
                            <input type="checkbox" class="checkbox" x-model="usarRecomendada" />
                        </label>
                    </div>

                    <!-- Configuración Avanzada (Colapsable con Alpine) -->
                    <div x-show="!usarRecomendada" class="space-y-4 pt-4 border-t">
                        <h3 class="font-semibold">Configuración Avanzada</h3>

                        <div>
                            <label for="altura_capa" class="block text-sm font-semibold mb-2">Altura de Capa (mm)</label>
                            <input type="number" id="altura_capa" name="altura_capa"
                                   step="0.05" min="0.05" max="0.5"
                                   class="input input-bordered w-full bg-base-200"
                                   placeholder="0.2" />
                        </div>

                        <div>
                            <label for="porcentaje_relleno" class="block text-sm font-semibold mb-2">Porcentaje de Relleno (%)</label>
                            <input type="number" id="porcentaje_relleno" name="porcentaje_relleno"
                                   min="0" max="100"
                                   class="input input-bordered w-full bg-base-200"
                                   placeholder="20" />
                        </div>

                        <div>
                            <label for="patron_relleno" class="block text-sm font-semibold mb-2">Patrón de Relleno</label>
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
</x-layouts::home>
