@props(['title' => null])

<x-layouts::basic :title="$title">
    <div
        class="flex min-h-screen w-full bg-base-100"
        x-data="{ open: $persist(true).as('admin_sidebar_open') }"
    >

        {{-- ===================== SIDEBAR ===================== --}}
        <aside
            :class="open ? 'w-56' : 'w-16'"
            class="relative flex shrink-0 flex-col border-r border-sky-500/30 bg-base-200 transition-all duration-300 ease-in-out"
        >

            {{-- Logo area --}}
            <div class="flex h-16 shrink-0 items-center overflow-hidden border-b border-sky-500/20 px-3">
                <a
                    href="{{ route('admin.reports') }}"
                    class="flex shrink-0 items-center justify-center rounded-md bg-base-300 p-1.5"
                    :class="open ? 'mr-3' : 'mx-auto'"
                >
                    <x-app-logo-icon class="size-7 fill-current text-base-content" />
                </a>

                <span
                    x-show="open"
                    x-transition:enter="transition-opacity duration-200 delay-100"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-75"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="truncate text-sm font-semibold tracking-wide text-base-content"
                >
                    MakeThis
                </span>
            </div>

            {{-- Nav items --}}
            @php
            $navItems = [
                [
                    'name'  => 'Reportes',
                    'route' => 'admin.reports',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />',
                ],
                [
                    'name'  => 'Solicitudes',
                    'route' => 'admin.requests',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />',
                ],
                [
                    'name'  => 'Usuarios',
                    'route' => 'admin.users',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />',
                ],
                [
                    'name'  => 'Catálogo',
                    'route' => 'admin.catalog',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />',
                ],
            ];
            @endphp

            <nav class="flex flex-1 flex-col gap-1 overflow-hidden px-2 py-4">
                @foreach($navItems as $item)
                @php $isActive = request()->routeIs($item['route']); @endphp

                <div
                    :class="open ? '' : 'tooltip tooltip-right'"
                    data-tip="{{ $item['name'] }}"
                >
                    <a
                        href="{{ route($item['route']) }}"
                        class="flex items-center gap-3 rounded-lg px-2 py-2.5 text-sm transition-colors duration-150
                               {{ $isActive
                                   ? 'border-l-2 border-primary bg-base-300 font-semibold text-primary'
                                   : 'border-l-2 border-transparent text-base-content/60 hover:bg-sky-500/10 hover:text-base-content' }}"
                        :class="open ? 'justify-start' : 'justify-center'"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="size-5 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            {!! $item['icon'] !!}
                        </svg>

                        <span
                            x-show="open"
                            x-transition:enter="transition-opacity duration-200 delay-150"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition-opacity duration-75"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="truncate"
                        >
                            {{ $item['name'] }}
                        </span>
                    </a>
                </div>
                @endforeach
            </nav>

            {{-- Bottom section --}}
            <div class="shrink-0 border-t border-sky-500/20 px-2 py-3 space-y-1">

                {{-- Volver a inicio --}}
                <div
                    :class="open ? '' : 'tooltip tooltip-right'"
                    data-tip="Inicio"
                >
                    <a
                        href="{{ route('home') }}"
                        class="flex items-center gap-3 rounded-lg px-2 py-2.5 text-sm text-base-content/50 transition-colors hover:bg-sky-500/10 hover:text-base-content border-l-2 border-transparent"
                        :class="open ? 'justify-start' : 'justify-center'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span
                            x-show="open"
                            x-transition:enter="transition-opacity duration-200 delay-150"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition-opacity duration-75"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="truncate"
                        >
                            Volver a inicio
                        </span>
                    </a>
                </div>

                {{-- Collapse toggle --}}
                <button
                    @click="open = !open"
                    class="flex w-full items-center gap-3 rounded-lg px-2 py-2.5 text-sm text-base-content/50 transition-colors hover:bg-sky-500/10 hover:text-base-content"
                    :class="open ? 'justify-start' : 'justify-center'"
                    :title="open ? 'Colapsar menú' : 'Expandir menú'"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="size-5 shrink-0 transition-transform duration-300"
                        :class="open ? 'rotate-0' : 'rotate-180'"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                    <span
                        x-show="open"
                        x-transition:enter="transition-opacity duration-200 delay-150"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity duration-75"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="truncate text-xs"
                    >
                        <span class="text-sm text-base-content/50">Colapsar menú</span>
                    </span>
                </button>

                {{-- Perfil + Cerrar sesión --}}
                <div class="border-t border-sky-500/20 pt-3 mt-1">
                    @auth
                    {{-- Avatar + info (solo expandido) --}}
                    <div
                        :class="open ? 'flex' : 'hidden'"
                        class="items-center gap-3 px-2 pb-2"
                    >
                        <div class="avatar placeholder shrink-0">
                            <div class="bg-primary/20 text-primary flex justify-center items-center rounded-full w-8 h-8 text-sm font-semibold">
                                <span>{{ strtoupper(substr(auth()->user()->nombre ?? '?', 0, 1)) }}</span>
                            </div>
                        </div>
                        <div class="min-w-0">
                            <p class="truncate text-xs font-medium text-base-content">
                                {{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}
                            </p>
                            <p class="truncate text-xs text-base-content/50">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                    </div>

                    {{-- Cerrar sesión --}}
                    <div
                        :class="open ? '' : 'tooltip tooltip-right'"
                        data-tip="Cerrar sesión"
                    >
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="flex w-full items-center gap-3 rounded-lg px-2 py-2.5 text-sm text-error/70 transition-colors hover:bg-error/10 hover:text-error cursor-pointer"
                                :class="open ? 'justify-start' : 'justify-center'"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span
                                    x-show="open"
                                    x-transition:enter="transition-opacity duration-200 delay-150"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition-opacity duration-75"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="truncate"
                                >
                                    Cerrar sesión
                                </span>
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>

            </div>

        </aside>
        {{-- ================== END SIDEBAR ================== --}}


        {{-- ================== MAIN CONTENT ================== --}}
        <main class="flex min-w-0 flex-1 flex-col">

            <div class="flex h-16 shrink-0 items-center border-b border-sky-500/20 bg-base-100 px-8">
                <span class="text-sm text-base-content/50">Panel de Administración</span>
            </div>

            <div class="flex-1 px-10 py-10">
                <div class="mx-auto max-w-7xl">
                    {{ $slot }}
                </div>
            </div>

        </main>
        {{-- ================ END MAIN CONTENT ================ --}}

    </div>
</x-layouts::basic>
