<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-base-100 text-base-content">
        <div class="min-h-screen flex flex-col">
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
            <main class="flex-1 flex items-center justify-center px-6 py-12">
                <div class="w-full max-w-md space-y-8">
                    {{-- Logo centrado --}}
                    <div class="flex justify-center">
                        <div class="flex h-24 w-24 items-center justify-center rounded-xl bg-base-200 shadow-sm">
                            <x-app-logo-icon class="size-16 fill-current text-black dark:text-white" />
                        </div>
                    </div>

                    {{-- Título --}}
                    <div class="text-center">
                        <h1 class="text-2xl font-bold uppercase tracking-wide">
                            ¿Has olvidado tu contraseña?
                        </h1>
                    </div>

                    {{-- Formulario --}}
                    <form action="/forgot-password" method="POST" class="space-y-6">
                        @csrf

                        {{-- Campo Email --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Email</span>
                            </label>
                            <input
                                type="email"
                                name="email"
                                placeholder="ejemplo@correo.com"
                                class="input input-bordered w-full"
                                required
                            />
                        </div>

                        {{-- Botón Validar --}}
                        <button type="submit" class="btn btn-primary w-full uppercase">
                            Validar
                        </button>

                        {{-- Link para volver --}}
                        <div class="text-center">
                            <a href="{{ route('home') }}" class="text-sm text-primary hover:underline">
                                Volver al inicio
                            </a>
                        </div>
                    </form>
                </div>
            </main>

            {{-- Footer --}}
            <x-home-footer />
        </div>
        @fluxScripts
    </body>
</html>