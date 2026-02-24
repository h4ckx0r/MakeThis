@props(['pieza'])

<div class="card border border-base-300 rounded-[30px] rounded-t-[50px]
            bg-base-100 transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 group">
    <figure class="bg-base-200 h-[250px] rounded-t-[40px] m-2.5 overflow-hidden">
        @if($pieza->adjunto && $pieza->adjunto->fichero)
            <img src="{{ asset('storage/' . $pieza->adjunto->fichero) }}"
                 alt="{{ $pieza->nombre }}"
                 class="w-full h-full object-cover rounded-[40px] transition-transform duration-300 group-hover:scale-105" />
        @else
            <div class="w-full h-full flex items-center justify-center text-base-300">
                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
    </figure>
    <div class="card-body p-4 pt-3">
        <h3 class="text-xl font-semibold text-center text-base-content truncate">
            {{ $pieza->nombre }}
        </h3>
        @if($pieza->descripcion)
        <p class="text-sm text-base-content/60 text-center line-clamp-2 leading-snug">
            {{ $pieza->descripcion }}
        </p>
        @endif
        <div class="flex flex-wrap gap-1.5 justify-center mt-2">
            @foreach($pieza->tags->take(3) as $tag)
                <x-piezas.tag :tag="$tag" />
            @endforeach
            @if($pieza->tags->count() > 3)
                <span class="badge badge-ghost badge-sm border border-base-300 text-base-content/50 rounded-full">
                    +{{ $pieza->tags->count() - 3 }}
                </span>
            @endif
        </div>
    </div>
</div>
