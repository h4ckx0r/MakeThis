<footer class="border-t border-base-300 bg-base-100">
    <div class="mx-auto max-w-7xl px-6 py-10">
        <div class="flex flex-col gap-10 lg:flex-row lg:items-start lg:justify-between">
            {{-- Logo --}}
            <div class="flex items-center">
                <span class="flex h-[140px] w-[146px] items-center justify-center rounded-[10px] border border-base-300 bg-base-200">
                    <x-app-logo-icon class="size-16 fill-current text-black dark:text-white" />
                </span>
            </div>

            {{-- MakeThis --}}
            <nav class="flex flex-col gap-4">
                <h2 class="text-[32px] font-normal underline text-center">MakeThis</h2>
                <a class="text-[20px] font-normal text-center">Enlace</a>
                <a class="text-[20px] font-normal text-center">Enlace</a>
                <a class="text-[20px] font-normal text-center">Enlace</a>
            </nav>

            {{-- Aspectos Legales --}}
            <nav class="flex flex-col gap-4">
                <h2 class="text-[32px] font-normal underline text-center">Aspectos Legales</h2>
                <a class="text-[20px] font-normal text-center">Enlace</a>
                <a class="text-[20px] font-normal text-center">Enlace</a>
                <a class="text-[20px] font-normal text-center">Enlace</a>
            </nav>

            {{-- Contacto --}}
            <nav class="flex flex-col gap-4">
                <h2 class="text-[32px] font-normal underline text-center">Contacto</h2>
                <a class="text-[20px] font-normal text-center">Enlace</a>
                <a class="text-[20px] font-normal text-center">Enlace</a>
                <a class="text-[20px] font-normal text-center">Enlace</a>
            </nav>

            {{-- Redes Sociales --}}
            <div class="flex flex-wrap gap-3 lg:justify-end">
                @foreach (range(1, 4) as $index)
                    <div class="flex h-[50px] w-[50px] items-center justify-center border border-base-300 bg-base-200 text-center text-[15px] font-normal leading-tight">
                        <span>Red<br>Social</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</footer>
