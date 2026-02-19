<x-layouts::home :title="'Solicitudes - Panel de Administración'">
    <div class="flex min-h-screen w-full flex-col py-6 text-white">
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

        <nav class="flex border-b border-sky-500/30 ">
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
        <div class="p-6 text-center text-neutral-400">
            <h2 class="text-2xl font-semibold mb-4">Sección de Solicitudes</h2>
            <p>Aquí podrás ver y gestionar las solicitudes realizadas por los usuarios.</p>
            <p class="mt-2 text-sm">Esta sección está en construcción.</p>
    </div>
</x-layouts::home>