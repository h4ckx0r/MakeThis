<footer class="border-t border-base-300 bg-base-100">
    <div class="mx-auto max-w-7xl px-6 py-10">
        <div class="flex flex-col gap-10 lg:flex-row lg:items-start lg:justify-between">
            <div class="flex items-center">
                <span class="flex h-16 w-16 items-center justify-center rounded-lg border border-base-300 bg-base-200">
                    <x-app-logo-icon class="size-8 fill-current text-black dark:text-white" />
                </span>
            </div>
            <nav class="flex flex-col gap-2">
                <h2 class="footer-title underline">MakeThis</h2>
                <a class="link link-hover">Enlace</a>
                <a class="link link-hover">Enlace</a>
                <a class="link link-hover">Enlace</a>
            </nav>
            <nav class="flex flex-col gap-2">
                <h2 class="footer-title underline">Aspectos Legales</h2>
                <a class="link link-hover">Enlace</a>
                <a class="link link-hover">Enlace</a>
                <a class="link link-hover">Enlace</a>
            </nav>
            <nav class="flex flex-col gap-2">
                <h2 class="footer-title underline">Contacto</h2>
                <a class="link link-hover">Enlace</a>
                <a class="link link-hover">Enlace</a>
                <a class="link link-hover">Enlace</a>
            </nav>
            <div class="flex flex-wrap gap-3 lg:justify-end">
                @foreach (range(1, 4) as $index)
                    <div class="flex h-12 w-12 items-center justify-center rounded-md border border-base-300 bg-base-200 text-center text-[10px] font-medium leading-tight">
                        <span>Red<br>Social</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</footer>
