@props(['title' => null])

<x-layouts::basic :title="$title">
    <div class="flex h-full w-full flex-1 flex-col">
        <livewire:navbar />

        {{-- Header Section --}}
        <div
            class="border-b border-neutral-200 bg-neutral-50 px-10 py-5 pt-28 dark:border-neutral-700 dark:bg-neutral-800">
            <div class="mx-auto flex max-w-7xl items-center justify-between">
                {{-- Profile Section --}}
                <div class="flex items-center gap-5">
                    <div
                        class="flex h-28 w-28 items-center justify-center rounded-full bg-neutral-400 text-center text-xs text-black">
                        Foto de<br>Perfil
                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="text-base font-medium">@Nombre</span>
                        <button
                            class="w-fit rounded border border-neutral-900 bg-white px-4 py-1 text-xl dark:border-neutral-100 dark:bg-neutral-900">⋯</button>
                    </div>
                </div>

                {{-- Header Navigation --}}
                <nav class="flex gap-2">
                    <button
                        class="rounded-full border border-neutral-900 bg-white px-5 py-2 text-sm transition hover:bg-neutral-100 dark:border-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800">Prioridades</button>
                    <button
                        class="rounded-full border border-neutral-900 bg-white px-5 py-2 text-sm transition hover:bg-neutral-100 dark:border-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800">Proximidad</button>
                    <button
                        class="rounded-full border border-neutral-900 bg-white px-5 py-2 text-sm transition hover:bg-neutral-100 dark:border-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800">Popularidad</button>
                    <button
                        class="rounded-full border border-neutral-900 bg-white px-5 py-2 text-sm transition hover:bg-neutral-100 dark:border-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800">Mi
                        Cuenta</button>
                </nav>
            </div>
        </div>

        {{-- Tab Navigation --}}
        @php
        $tabs = [
        ['name' => 'Reportes', 'route' => 'admin.reports'],
        ['name' => 'Solicitudes', 'route' => 'admin.requests'],
        ['name' => 'Mensajes', 'route' => null],
        ['name' => 'Usuarios', 'route' => 'admin.users'],
        ['name' => 'Catálogo', 'route' => 'admin.catalog'],
        ];
        @endphp

        <nav class="flex border-b border-neutral-900 dark:border-neutral-100">
            @foreach($tabs as $tab)
            @php
            $isActive = $tab['route'] && request()->routeIs($tab['route']);
            $classes = $isActive
            ? 'bg-white font-semibold dark:bg-neutral-900'
            : 'bg-neutral-100 transition hover:bg-neutral-200 dark:bg-neutral-800 dark:hover:bg-neutral-700';
            $commonClasses = 'flex-1 max-w-[200px] border-r border-neutral-900 px-8 py-3 text-sm text-center
            dark:border-neutral-100';
            @endphp

            @if($tab['route'])
            <a href="{{ route($tab['route']) }}" class="{{ $commonClasses }} {{ $classes }}">
                {{ $tab['name'] }}
            </a>
            @else
            <button class="{{ $commonClasses }} {{ $classes }}">
                {{ $tab['name'] }}
            </button>
            @endif
            @endforeach
        </nav>

        {{-- Main Content --}}
        <div class="flex-1 px-10 py-8">
            <div class="mx-auto max-w-7xl">
                {{ $slot }}
            </div>
        </div>

        <livewire:footer />
    </div>
</x-layouts::basic>