<div>

    {{-- Error alert --}}
    @if ($errorMessage)
    <div role="alert" class="alert alert-error mb-4 text-sm py-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="flex-1">{{ $errorMessage }}</span>
        <button type="button" wire:click="$set('errorMessage', null)" class="btn btn-ghost btn-xs">✕</button>
    </div>
    @endif

    {{-- Add new tag --}}
    <form wire:submit.prevent="addTag" class="flex gap-2 mb-2">
        <input
            type="text"
            wire:model="newName"
            placeholder="Nueva categoría..."
            class="input input-bordered input-sm flex-1 bg-base-300 border-sky-500/30 text-base-content
                   placeholder-base-content/40 focus:border-sky-400 focus:outline-none
                   @error('newName') border-error @enderror"
        />
        <button type="submit" class="btn btn-primary btn-sm">Añadir</button>
    </form>
    @error('newName')
    <p class="text-error text-xs mb-4">{{ $message }}</p>
    @else
    <div class="mb-4"></div>
    @enderror

    {{-- Tag list --}}
    <div class="space-y-2 max-h-72 overflow-y-auto pr-1">
        @forelse ($tags as $tag)
        <div class="flex items-center gap-2 rounded-lg bg-base-300 px-3 py-2 border border-sky-500/10">

            @if ($editingId === $tag->id)
            {{-- Inline edit form --}}
            <form wire:submit.prevent="saveEdit" class="flex flex-1 items-center gap-2">
                <input
                    type="text"
                    wire:model="editingName"
                    class="input input-bordered input-xs flex-1 bg-base-200 border-sky-500/30
                           text-base-content focus:border-sky-400 @error('editingName') border-error @enderror"
                    autofocus
                />
                <button type="submit" class="btn btn-success btn-xs">Guardar</button>
                <button type="button" wire:click="cancelEdit" class="btn btn-ghost btn-xs">Cancelar</button>
            </form>
            @error('editingName')
            <p class="text-error text-xs mt-1 w-full">{{ $message }}</p>
            @enderror

            @elseif ($confirmingDeleteId === $tag->id)
            {{-- Inline delete confirmation --}}
            <span class="flex-1 text-sm text-base-content/60">
                ¿Eliminar <strong class="text-base-content">{{ $tag->nombre }}</strong>?
            </span>
            <button type="button" wire:click="deleteTag" class="btn btn-error btn-xs">Sí, eliminar</button>
            <button type="button" wire:click="cancelDelete" class="btn btn-ghost btn-xs">Cancelar</button>

            @else
            {{-- Normal row --}}
            <span class="flex-1 text-sm font-medium text-base-content">{{ $tag->nombre }}</span>
            <span class="badge badge-soft badge-neutral badge-xs mr-1">
                {{ $tag->pieza_catalogos_count }} pieza(s)
            </span>
            <button type="button" wire:click="startEdit('{{ $tag->id }}')"
                    class="btn btn-ghost btn-xs text-primary hover:text-primary/80">
                Editar
            </button>
            <button type="button" wire:click="confirmDelete('{{ $tag->id }}')"
                    class="btn btn-ghost btn-xs text-error hover:text-red-400">
                Eliminar
            </button>
            @endif

        </div>
        @empty
        <p class="py-8 text-center text-sm text-base-content/40">
            No hay categorías creadas aún.
        </p>
        @endforelse
    </div>

</div>
