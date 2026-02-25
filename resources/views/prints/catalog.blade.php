<x-layouts::home :title="'Catálogo de Piezas'">
    <main class="grow">

        {{-- Cabecera --}}
        <section class="border-b border-base-300">
            <div class="mx-auto max-w-7xl px-6 py-16 text-center">
                <h1 class="text-5xl font-semibold sm:text-6xl lg:text-7xl mb-4">Catálogo</h1>
                <p class="text-lg text-base-content/60">Explora nuestras piezas o busca por nombre y categoría</p>
            </div>
        </section>

        {{-- Filtros --}}
        <section class="border-b border-base-300">
            <div class="mx-auto max-w-7xl px-6 py-8">
                <form method="GET" action="{{ route('prints.catalog') }}" id="catalog-form">

                    {{-- Input de búsqueda --}}
                    <div class="relative max-w-2xl mx-auto">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-base-content/50 pointer-events-none z-10"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input
                            id="search-input"
                            type="text"
                            name="search"
                            value="{{ request('search', '') }}"
                            placeholder="Busca una pieza o escribe #categoría..."
                            autocomplete="off"
                            class="input w-full bg-base-200 border border-base-300 pl-12 pr-4 rounded-xl
                                   focus:border-primary focus:outline-none focus:bg-base-100 transition-colors"
                        />
                    </div>

                    {{-- Tags activos como chips removibles --}}
                    @php $activeTags = request('tags', []); @endphp
                    <div id="active-tags-container" class="flex flex-wrap gap-2 mt-4 max-w-2xl mx-auto min-h-[1px]">
                        @foreach($activeTags as $activeTagId)
                            @php $tagObj = $availableTags->firstWhere('id', $activeTagId); @endphp
                            @if($tagObj)
                            <span class="badge badge-primary badge-lg gap-1 pr-1 cursor-default"
                                  data-tag-id="{{ $tagObj->id }}">
                                #{{ $tagObj->nombre }}
                                <button type="button"
                                        class="btn btn-ghost btn-xs btn-circle text-primary-content/70 hover:text-primary-content ml-0.5"
                                        onclick="removeTag('{{ $tagObj->id }}')">✕</button>
                                <input type="hidden" name="tags[]" value="{{ $tagObj->id }}" />
                            </span>
                            @endif
                        @endforeach
                    </div>

                    {{-- Tags disponibles --}}
                    <div id="available-tags-list" class="flex flex-wrap gap-2 mt-3 max-w-2xl mx-auto">
                        @foreach($availableTags as $tag)
                            @if(!in_array($tag->id, $activeTags))
                            <button
                                type="button"
                                class="badge badge-outline badge-lg cursor-pointer hover:badge-primary transition-colors"
                                data-tag-id="{{ $tag->id }}"
                                data-tag-nombre="{{ strtolower($tag->nombre) }}"
                                onclick="addTag('{{ $tag->id }}', '{{ $tag->nombre }}')"
                            >#{{ $tag->nombre }}</button>
                            @endif
                        @endforeach
                    </div>

                </form>
            </div>
        </section>

        {{-- Grid de piezas --}}
        <section>
            <div class="mx-auto max-w-7xl px-6 py-12">
                @if($piezas->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    @foreach($piezas as $pieza)
                    <x-piezas.card :pieza="$pieza" />
                    @endforeach
                </div>

                <div class="flex justify-center">
                    {{ $piezas->links() }}
                </div>
                @else
                <div class="text-center py-20">
                    <svg class="mx-auto h-16 w-16 text-base-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">No se encontraron piezas</h3>
                    <p class="text-base-content/60">Intenta ajustar tus filtros de búsqueda</p>
                    <a href="{{ route('prints.catalog') }}" class="btn btn-ghost btn-sm mt-4">Limpiar filtros</a>
                </div>
                @endif
            </div>
        </section>

    </main>

    <script>
        const allTags = @json($availableTags->map(fn($t) => ['id' => $t->id, 'nombre' => strtolower($t->nombre)]));
        const searchInput = document.getElementById('search-input');

        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                handleHashtagSearch();
            }
        });

        function handleHashtagSearch() {
            const val = searchInput.value.trim();
            if (val.startsWith('#') && val.length > 1) {
                const tagQuery = val.slice(1).toLowerCase().trim();
                const match = allTags.find(t => t.nombre === tagQuery || t.nombre.startsWith(tagQuery));
                if (match) {
                    addTag(match.id, match.nombre);
                    searchInput.value = '';
                    return;
                }
            }
            document.getElementById('catalog-form').submit();
        }

        function addTag(tagId, tagNombre) {
            const existing = document.querySelector(`#active-tags-container [data-tag-id="${tagId}"]`);
            if (existing) return;

            const container = document.getElementById('active-tags-container');
            const chip = document.createElement('span');
            chip.className = 'badge badge-primary badge-lg gap-1 pr-1 cursor-default';
            chip.dataset.tagId = tagId;
            chip.innerHTML = `#${tagNombre}
                <button type="button"
                        class="btn btn-ghost btn-xs btn-circle text-primary-content/70 hover:text-primary-content ml-0.5"
                        onclick="removeTag('${tagId}')">✕</button>
                <input type="hidden" name="tags[]" value="${tagId}" />`;
            container.appendChild(chip);

            const availableBtn = document.querySelector(`#available-tags-list [data-tag-id="${tagId}"]`);
            if (availableBtn) availableBtn.style.display = 'none';

            // Limpiar el input ANTES del submit para que no filtre por el texto #hashtag
            document.getElementById('search-input').value = '';

            document.getElementById('catalog-form').submit();
        }

        function removeTag(tagId) {
            const chip = document.querySelector(`#active-tags-container [data-tag-id="${tagId}"]`);
            if (chip) chip.remove();

            const availableBtn = document.querySelector(`#available-tags-list [data-tag-id="${tagId}"]`);
            if (availableBtn) availableBtn.style.display = '';

            document.getElementById('catalog-form').submit();
        }
    </script>

</x-layouts::home>
