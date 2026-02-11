<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-base-100 text-base-content">
        <div class="min-h-screen flex flex-col">
            {{-- Navbar --}}
            <x-home-navbar />

            {{-- Sección de perfil y animación --}}
            <section class="border-b border-base-300">
                <div class="mx-auto max-w-7xl px-6 py-12">
                    <div class="flex items-center justify-between gap-8">
                        {{-- Foto de perfil --}}
                        <div class="flex h-[200px] w-[200px] items-center justify-center rounded-full border border-base-300 bg-base-200 flex-shrink-0">
                            <span class="text-[20px] font-normal text-center">Foto de Perfil</span>
                        </div>

                        {{-- Info del usuario --}}
                        <div class="flex flex-col gap-2">
                            {{-- Nombre de usuario --}}
                            <div class="flex items-center justify-center rounded-[10px] border border-base-300 w-[153px] h-[27px] overflow-hidden">
                                <span class="text-[14px] font-normal whitespace-nowrap">@Nombre del Usuario</span>
                            </div>

                            {{-- Botones Contacto y ... --}}
                            <div class="flex gap-2">
                                <button class="flex items-center justify-center rounded-[10px] border border-base-300 w-[69px] h-[27px] overflow-hidden">
                                    <span class="text-[14px] font-normal">Contacto</span>
                                </button>
                                <button class="flex items-center justify-center rounded-[10px] border border-base-300 w-[69px] h-[27px]">
                                    <span class="text-[20px] font-normal">...</span>
                                </button>
                            </div>
                        </div>

                        {{-- Texto de animación --}}
                        <h1 class="text-[48px] font-normal flex-1 text-center">
                            Animación
                        </h1>
                    </div>
                </div>
            </section>

            {{-- Tabs de navegación --}}
            <section class="border-b border-base-300">
                <div class="mx-auto max-w-7xl px-6 py-2.5">
                    <div class="flex gap-3">
                        {{-- Tab Solicitudes (activo) --}}
                        <a href="{{ route('solicitudes-cliente') }}" class="flex items-center justify-center rounded-[10px] border border-base-300 bg-base-200 w-[106px] h-[40px]">
                            <span class="text-[16px] font-normal">Solicitudes</span>
                        </a>

                        {{-- Tab Me Gusta --}}
                        <a href="{{ route('me-gusta-cliente') }}" class="flex items-center justify-center rounded-[10px] border border-base-300 w-[106px] h-[40px]">
                            <span class="text-[16px] font-normal">Me Gusta</span>
                        </a>

                        {{-- Tab Mensajes --}}
                        <button class="flex items-center justify-center rounded-[10px] border border-base-300 w-[106px] h-[40px]">
                            <span class="text-[16px] font-normal">Mensajes</span>
                        </button>
                    </div>
                </div>
            </section>

            {{-- Contenido principal - Solicitudes --}}
            <main class="flex-1 border-b border-base-300">
                <div class="mx-auto max-w-7xl px-6 py-8">
                    {{-- Título --}}
                    <h2 class="text-[32px] font-semibold mb-8">
                        SOLICITUDES DE "USUARIO"
                    </h2>

                    {{-- Grid de solicitudes --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach (range(1, 4) as $index)
                            <div class="flex items-center justify-center rounded-[10px] border border-base-300 bg-base-200 h-[211px]">
                                <span class="text-[32px] font-normal">Solicitud</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </main>

            {{-- Footer --}}
            <x-home-footer />
        </div>
        @fluxScripts
    </body>
</html>
