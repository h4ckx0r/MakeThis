<div>
    <!-- Búsqueda -->
    <div class="relative max-w-2xl mx-auto mb-6">
        <input type="text" wire:model.live="search" placeholder="Busca una pieza"
               class="input input-bordered w-full rounded-lg bg-base-200 pl-10" />
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>

    <!-- Tags -->
    <div class="flex flex-wrap gap-2 justify-center">
        @foreach($availableTags as $tag)
            <button wire:click="toggleTag({{ $tag->id }})"
                    class="badge {{ in_array($tag->id, $selectedTags)
                           ? 'badge-primary' : 'badge-outline' }} badge-lg">
                #{{ $tag->nombre }}
            </button>
        @endforeach
    </div>
</div>
