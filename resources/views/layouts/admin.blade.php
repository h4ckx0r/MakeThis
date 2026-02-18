@props(['title' => null])

<x-layouts::basic :title="$title">
    <div class="flex min-h-screen w-full flex-col bg-black text-white">

        <livewire:navbar />

        {{-- Header Section --}}
        <header class="border-b border-sky-500/30 bg-neutral-950 px-10 py-6 pt-28">
            <div class="mx-auto flex max-w-7xl items-center justify-between">

                {{-- Profile Section --}}
                <div class="flex items-center gap-6">
                    <div class="flex h-28 w-28 items-center justify-center rounded-full
                               border border-sky-500/40 bg-black
                               text-center text-xs text-neutral-300">
                        Foto de<br>Perfil
                    </div>

                    <div class="flex flex-col gap-3">
                        <span class="text-lg font-medium tracking-wide">
                            @Nombre
                        </span>
                        <button class="w-fit rounded-full border border-sky-500/40
                                   px-4 py-1 text-xl text-sky-400
                                   hover:bg-sky-500/10 transition">
                            ⋯
                        </button>
                    </div>
                </div>

            </div>
        </header>

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

        <nav class="flex border-b border-sky-500/30 bg-black">
            @foreach($tabs as $tab)
            @php
            $isActive = $tab['route'] && request()->routeIs($tab['route']);

            $baseClasses = '
            flex-1 max-w-[200px]
            px-8 py-4 text-sm text-center
            border-r border-sky-500/20
            transition
            ';

            $stateClasses = $isActive
            ? 'bg-neutral-950 text-sky-400 font-semibold'
            : 'text-neutral-400 hover:bg-sky-500/10 hover:text-white';
            @endphp

            @if($tab['route'])
            <a href="{{ route($tab['route']) }}" class="{{ $baseClasses }} {{ $stateClasses }}">
                {{ $tab['name'] }}
            </a>
            @else
            <button class="{{ $baseClasses }} {{ $stateClasses }}">
                {{ $tab['name'] }}
            </button>
            @endif
            @endforeach
        </nav>

        {{-- Main Content --}}
        <main class="flex-1 px-10 py-10">
            <div class="mx-auto max-w-7xl">
                {{ $slot }}
            </div>
        </main>

        <livewire:footer />

    </div>
</x-layouts::basic>