<x-layouts::home :title="'Pieza Personalizada'">
    <main class="grow container mx-auto px-4 py-6 md:py-12"
          x-data="{
              materialId: '',
              colorId: '',
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
          }">

        <div class="mb-6 md:mb-12">
            <h1 class="text-2xl sm:text-4xl font-bold mb-2">Pieza Personalizada</h1>
            <p class="text-base-content/60">Cuéntanos tu idea y nuestros diseñadores crearán el modelo perfecto para ti</p>
        </div>

        <form action="{{ route('prints.preview.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <input type="hidden" name="tipo" value="personalizada">
            <input type="hidden" name="materialId" x-model="materialId">
            <input type="hidden" name="colorId"    x-model="colorId">

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
                    <div x-data="{ archivoNombre: '' }"
                         class="border-2 border-dashed border-base-content/30 rounded-3xl h-80 flex flex-col items-center justify-center gap-4 cursor-pointer bg-base-200 hover:bg-base-300 transition-colors"
                         @dragover.prevent
                         @drop.prevent="
                             const f = $event.dataTransfer.files[0];
                             if (f) { $refs.fileInput.files = $event.dataTransfer.files; archivoNombre = f.name; }
                         "
                         @click="$refs.fileInput.click()">
                        <svg class="w-16 h-16 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-base-content/60 text-center px-4"
                           x-text="archivoNombre ? 'Imagen lista: ' + archivoNombre : 'Arrastra tu imagen aquí o haz clic para seleccionar'"></p>
                        <p class="text-sm text-base-content/40">JPG, PNG, GIF, WEBP — máx. 10MB</p>
                        <input type="file" name="file_imagen" accept=".jpg,.jpeg,.png,.gif,.webp" class="hidden"
                               x-ref="fileInput"
                               @change="archivoNombre = $event.target.files[0]?.name || ''">
                    </div>
                    @error('file_imagen')
                        <span class="text-error text-sm mt-1 block">{{ $message }}</span>
                    @enderror
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
            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <a href="{{ route('prints.request') }}" class="btn btn-outline w-full sm:w-auto">Cancelar</a>
                <button type="submit" class="btn btn-primary sm:flex-1">Vista Previa</button>
            </div>
        </form>
    </main>
</x-layouts::home>
