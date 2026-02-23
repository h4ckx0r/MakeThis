<x-layouts::home :title="'Pieza Personalizada'">
    <main class="grow container mx-auto px-4 py-12"
          x-data="{
              materialId: '',
              colorId: '',
              archivoPath: '',
              archivoNombre: '',
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
              if ($event.detail.tipo === 'imagen') {
                  archivoPath   = $event.detail.path;
                  archivoNombre = $event.detail.name;
              }
          ">

        <div class="mb-12">
            <h1 class="text-4xl font-bold mb-2">Pieza Personalizada</h1>
            <p class="text-base-content/60">Cuéntanos tu idea y nuestros diseñadores crearán el modelo perfecto para ti</p>
        </div>

        <form action="{{ route('prints.preview.store') }}" method="POST" class="space-y-8">
            @csrf
            <input type="hidden" name="tipo" value="personalizada">
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
                <!-- Columna Izquierda: Drag & Drop de Imágenes -->
                <div>
                    <label class="block text-lg font-semibold mb-4">Imagen de Referencia (opcional)</label>
                    @livewire('piezas.file-uploader', ['tipo' => 'imagen'])
                    <p x-show="archivoNombre" class="mt-2 text-sm text-success font-medium"
                       x-text="'Imagen lista: ' + archivoNombre"></p>
                </div>

                <!-- Columna Derecha: Formulario -->
                <div class="space-y-6">
                    <!-- Material -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Material Preferido</label>
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
                        <label class="block text-sm font-semibold mb-2">Color Preferido</label>
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

                    <!-- Opciones -->
                    <div class="space-y-3">
                        <h3 class="font-semibold">¿Qué incluir?</h3>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">Incluir modelo 3D (para futuras impresiones)</span>
                                <input type="checkbox" name="incluye_modelo_3d" value="1" class="checkbox" />
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">Incluir pieza impresa en la entrega</span>
                                <input type="checkbox" name="incluye_pieza" value="1" class="checkbox" checked />
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
                @error('indicaciones')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex gap-4 pt-6">
                <a href="{{ route('prints.request') }}" class="btn btn-outline">Cancelar</a>
                <button type="submit" class="btn btn-primary flex-1">Vista Previa</button>
            </div>
        </form>
    </main>
</x-layouts::home>
