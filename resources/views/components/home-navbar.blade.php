<header class="border-b border-base-300">
    <div class="navbar mx-auto max-w-7xl px-6 py-4">
        <div class="flex-1">
            <a href="{{ route('home') }}" class="flex items-center gap-3 text-lg font-semibold" wire:navigate>
                <span class="flex h-10 w-10 items-center justify-center rounded-md bg-base-200">
                    <x-app-logo-icon class="size-6 fill-current text-black dark:text-white" />
                </span>
                <span>MakeThis</span>
            </a>
        </div>
        <div class="flex-none">
            <div class="rounded-full border border-base-300 bg-base-200 px-4 py-2">
                <ul class="menu menu-horizontal gap-2 p-0">
                    <li>
                        <span class="h-6 w-10 rounded-full bg-base-300"></span>
                    </li>
                    @foreach (range(1, 4) as $index)
                        <li>
                            <a class="text-sm font-medium">Placeholder</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</header>
