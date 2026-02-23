<x-layouts::home :title="'Catálogo de Piezas'">
    <main class="grow container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold mb-4">Catálogo de Piezas</h1>
            <p class="text-xl text-base-content/60">Busque en nuestro catálogo</p>
        </div>

        <!-- Filtros -->
        <form method="GET" action="{{ route('prints.catalog') }}" class="mb-12">
            <!-- Búsqueda -->
            <div class="relative max-w-2xl mx-auto mb-6">
                <input type="text" name="search" placeholder="Busca una pieza" value="{{ request('search', '') }}"
                    class="input input-bordered w-full rounded-lg bg-base-200 pl-10" />
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <!-- Tags -->
            <div class="flex flex-wrap gap-2 justify-center">
                @foreach($availableTags as $tag)
                <label
                    class="badge badge-lg cursor-pointer {{ in_array($tag->id, request('tags', [])) ? 'badge-primary' : 'badge-outline' }}">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                           {{ in_array($tag->id, request('tags', [])) ? 'checked' : '' }}
                           class="hidden" onchange="this.form.submit()" />
                    #{{ $tag->nombre }}
                </label>
                @endforeach
            </div>
        </form>

        <!-- Grid de Piezas -->
        @if($piezas->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @foreach($piezas as $pieza)
            <x-piezas.card :pieza="$pieza" />
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="flex justify-center mb-12">
            {{ $piezas->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <svg class="mx-auto h-16 w-16 text-base-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-xl font-semibold mb-2">No se encontraron piezas</h3>
            <p class="text-base-content/60">Intenta ajustar tus filtros de búsqueda</p>
        </div>
        @endif
    </main>
</x-layouts::home>
