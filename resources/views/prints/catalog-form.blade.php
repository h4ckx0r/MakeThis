<x-layouts::home :title="'Solicitar: ' . $pieza->nombre">
    <main class="grow container mx-auto px-4 py-12"
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

        <div class="mb-12">
            <a href="{{ route('prints.catalog') }}" class="text-sm text-base-content/50 hover:text-primary mb-3 inline-flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al catálogo
            </a>
            <h1 class="text-4xl font-bold mb-2">{{ $pieza->nombre }}</h1>
            @if($pieza->descripcion)
            <p class="text-base-content/60">{{ $pieza->descripcion }}</p>
            @endif
        </div>

        <form action="{{ route('prints.preview.store') }}" method="POST" class="space-y-8">
            @csrf
            <input type="hidden" name="tipo"    value="catalogo">
            <input type="hidden" name="piezaId" value="{{ $pieza->id }}">
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
                <!-- Columna Izquierda: Imagen de la pieza -->
                <div>
                    <label class="block text-lg font-semibold mb-4">Pieza Seleccionada</label>
                    <div class="border-2 border-base-content/10 rounded-3xl h-80 overflow-hidden bg-base-200 flex items-center justify-center">
                        @if($pieza->adjunto && $pieza->adjunto->fichero)
                            <img src="{{ asset('storage/' . $pieza->adjunto->fichero) }}"
                                 alt="{{ $pieza->nombre }}"
                                 class="w-full h-full object-cover" />
                        @else
                            <div class="flex flex-col items-center gap-3 text-base-content/30">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm">Sin imagen disponible</span>
                            </div>
                        @endif
                    </div>

                    @if($pieza->tags->count())
                    <div class="flex flex-wrap gap-1.5 mt-3">
                        @foreach($pieza->tags as $tag)
                            <x-piezas.tag :tag="$tag" />
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Columna Derecha: Material y Color -->
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
                </div>
            </div>

            <!-- Indicaciones opcionales -->
            <div>
                <label for="indicaciones" class="block text-sm font-semibold mb-2">
                    Indicaciones Especiales
                    <span class="text-base-content/40 font-normal">(opcional)</span>
                </label>
                <textarea id="indicaciones" name="indicaciones" rows="4"
                          class="textarea textarea-bordered w-full bg-base-200"
                          placeholder="¿Algún detalle especial sobre el acabado, color exacto u otra indicación?"></textarea>
                @error('indicaciones')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex gap-4 pt-6">
                <a href="{{ route('prints.catalog') }}" class="btn btn-outline">Cancelar</a>
                <button type="submit" class="btn btn-primary flex-1">Vista Previa</button>
            </div>
        </form>
    </main>
</x-layouts::home>
