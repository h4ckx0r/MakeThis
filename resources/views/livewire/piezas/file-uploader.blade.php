<div class="border-2 border-dashed border-base-300 rounded-[50px] h-125
            flex items-center justify-center"
     x-data="{ dragging: false }"
     @dragover.prevent="dragging = true"
     @dragleave.prevent="dragging = false"
     @drop.prevent="
         dragging = false;
         const dt = $event.dataTransfer;
         if (dt.files.length) {
             $refs.fileInput.files = dt.files;
             $refs.fileInput.dispatchEvent(new Event('change'));
         }
     "
     :class="{ 'border-primary bg-base-200': dragging }">

    @if ($file)
        <div class="text-center space-y-4">
            <svg class="mx-auto h-20 w-20 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <p class="text-xl">{{ $file->getClientOriginalName() }}</p>
            <button type="button" wire:click="$set('file', null)" class="btn btn-sm">
                Cambiar archivo
            </button>
        </div>
    @else
        <div class="text-center space-y-4">
            <div class="bg-base-200 rounded-[40px] w-40 h-36 mx-auto flex items-center justify-center">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
            </div>
            <p class="text-xl max-w-md">{{ $placeholder }}</p>
            <input type="file" wire:model="file" accept="{{ $acceptedFormats }}"
                   class="hidden" x-ref="fileInput" />
            <button type="button" @click="$refs.fileInput.click()" class="btn btn-primary">
                Seleccionar archivo
            </button>
        </div>
    @endif
    @error('file')
        <p class="mt-3 text-sm text-error text-center">{{ $message }}</p>
    @enderror
</div>
