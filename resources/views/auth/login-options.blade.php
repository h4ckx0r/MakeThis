<x-layouts::home title="Iniciar Sesión">
            {{-- Header simple con logo --}}
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
                </div>
            </header>

            {{-- Contenido principal centrado --}}
            <main class="flex-1 flex items-center justify-center px-6 py-12 relative">
                {{-- Flecha de retroceso --}}
                <a href="{{ route('home') }}" class="absolute top-8 left-8 text-2xl hover:opacity-70 transition-opacity">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>

                <div class="w-full max-w-lg space-y-8">
                    {{-- Logo centrado --}}
                    <div class="flex justify-center">
                        <div class="flex h-24 w-24 items-center justify-center rounded-xl bg-base-200 shadow-sm">
                            <x-app-logo-icon class="size-16 fill-current text-black dark:text-white" />
                        </div>
                    </div>

                    {{-- Título --}}
                    <div class="text-center">
                        <h1 class="text-2xl font-semibold">
                            INICIAR SESIÓN
                        </h1>
                    </div>

                    {{-- Opciones de inicio de sesión --}}
                    <div class="space-y-4">
                        {{-- Iniciar sesión con correo electrónico --}}
                        <a href="{{ route('home') }}" class="btn btn-outline rounded-full w-full normal-case text-[15px] font-normal h-14 flex items-center justify-center">
                            INICIAR SESIÓN CON UN CORREO ELECTRÓNICO
                        </a>

                        {{-- Google --}}
                        <button type="button" class="btn btn-outline rounded-full w-full normal-case text-[15px] font-normal h-14 flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            GOOGLE
                        </button>

                        {{-- Facebook --}}
                        <button type="button" class="btn btn-outline rounded-full w-full normal-case text-[15px] font-normal h-14 flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" fill="#1877F2"/>
                            </svg>
                            FACEBOOK
                        </button>

                        {{-- Apple, Yahoo, GitHub en fila --}}
                        <div class="grid grid-cols-3 gap-3">
                            {{-- Apple --}}
                            <button type="button" class="btn btn-outline rounded-full normal-case text-[15px] font-normal h-14 flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                                </svg>
                                APPLE
                            </button>

                            {{-- Yahoo --}}
                            <button type="button" class="btn btn-outline rounded-full normal-case text-[15px] font-normal h-14 flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.5 1.6L8.3 10.5H11L9.3 15.2L14.8 6.2H12.3L15.5 1.6H12.5zM6.5 10.5L2 1.6H5L9.5 10.5H6.5zM14.5 10.5L19 1.6H16L11.5 10.5H14.5zM7.8 17.8H16.2V22.4H7.8V17.8z" fill="#5F01D1"/>
                                </svg>
                                YAHOO
                            </button>

                            {{-- GitHub --}}
                            <button type="button" class="btn btn-outline rounded-full normal-case text-[15px] font-normal h-14 flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                                GITHUB
                            </button>
                        </div>

                        {{-- Link crear cuenta --}}
                        <div class="text-center pt-4">
                            <a href="{{ route('register') }}" class="text-base font-normal underline hover:text-primary">
                                Crear una cuenta gratis
                            </a>
                        </div>
                    </div>
                </div>
            </main>
</x-layouts::home>
