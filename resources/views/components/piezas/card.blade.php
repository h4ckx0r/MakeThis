@props(['pieza'])

<div class="card border border-base-300 rounded-[30px] rounded-t-[50px]">
    <figure class="bg-base-200 h-[250px] rounded-t-[40px] m-2.5">
        @if($pieza->adjunto && $pieza->adjunto->fichero)
            <img src="{{ asset('storage/' . $pieza->adjunto->fichero) }}"
                 alt="{{ $pieza->nombre }}"
                 class="w-full h-full object-cover rounded-[40px]" />
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-20 h-20 text-base-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
    </figure>
    <div class="card-body p-4">
        <h3 class="text-2xl font-semibold text-center">{{ $pieza->nombre }}</h3>
        <div class="flex flex-wrap gap-2 justify-center">
            @foreach($pieza->tags->take(4) as $tag)
                <x-piezas.tag :tag="$tag" />
            @endforeach
        </div>
    </div>
</div>
