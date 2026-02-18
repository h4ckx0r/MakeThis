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
        <main class="flex-1 flex items-center justify-center px-6 py-12 relative">
            {{-- Flecha de retroceso --}}
            <a href="{{ route('home') }}" class="absolute top-8 left-8 text-2xl hover:opacity-70 transition-opacity">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <div class="w-full max-w-2xl space-y-6">
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

                {{-- Estado de sesión --}}
                @if (session('status'))
                    <div class="text-center font-medium text-sm text-success">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Formulario --}}
                <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Campo Email --}}
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                        class="input input-bordered rounded-lg w-full h-13.25 text-[15px] font-normal"
                        required autofocus autocomplete="email" />
                    @error('email') <span class="text-error text-sm">{{ $message }}</span> @enderror

                    {{-- Campo Contraseña --}}
                    <div class="relative">
                        <input type="password" name="password" placeholder="Contraseña"
                            class="input input-bordered rounded-lg w-full h-13.25 text-[15px] font-normal pr-12"
                            required autocomplete="current-password" />
                        <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2" x-data="{ show: false }"
                            x-on:click="show = !show; $el.previousElementSibling.type = show ? 'text' : 'password'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password') <span class="text-error text-sm">{{ $message }}</span> @enderror

                    {{-- Link olvidaste contraseña --}}
                    @if (Route::has('password.request'))
                        <div class="flex justify-end">
                            <a href="{{ route('password.request') }}" class="text-[15px] font-normal underline hover:text-primary">
                                ¿Has olvidado tu contraseña?
                            </a>
                        </div>
                    @endif

                    {{-- Checkbox Recordarme --}}
                    <div class="flex items-center gap-3 py-1">
                        <input type="checkbox" name="remember" class="checkbox checkbox-sm border border-black"
                            {{ old('remember') ? 'checked' : '' }} />
                        <span class="text-[15px] font-normal">Recordarme</span>
                    </div>

                    {{-- Link crear cuenta --}}
                    @if (Route::has('register'))
                        <div class="text-center pt-2">
                            <a href="{{ route('register') }}" class="text-[15px] font-normal underline hover:text-primary">
                                ¿No tienes una cuenta? Regístrate aquí
                            </a>
                        </div>
                    @endif

                    {{-- Botón Iniciar Sesión --}}
                    <button type="submit"
                        class="btn btn-primary rounded-full w-full h-13.25 normal-case text-[15px] font-normal mt-6">
                        INICIAR SESIÓN
                    </button>
                </form>
            </div>
        </main>

        {{-- Footer --}}
        <x-home-footer />
    </div>
    @fluxScripts
</body>

</html>
