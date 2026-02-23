<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="bg-base-100 text-base-content">
    <div class="min-h-screen flex flex-col">
        <header class="border-b border-base-300">
            <div class="navbar mx-auto max-w-7xl px-6 py-4">
                <div class="flex-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 text-lg font-semibold">
                        <span class="flex h-10 w-10 items-center justify-center rounded-md bg-base-200">
                            <x-app-logo-icon class="size-6 fill-current text-black dark:text-white" />
                        </span>
                        <span>MakeThis</span>
                    </a>
                </div>
            </div>
        </header>

        <main class="flex-1 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md text-center space-y-6">
                @if($success)
                    <div class="flex justify-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-success/10">
                            <svg class="w-10 h-10 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-2xl font-semibold">Correo verificado</h1>
                    <p class="text-base-content/70">
                        Tu dirección de correo electrónico ha sido verificada correctamente.<br>
                        Puedes cerrar esta pestaña y continuar con el registro.
                    </p>
                @else
                    <div class="flex justify-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-error/10">
                            <svg class="w-10 h-10 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-2xl font-semibold">Enlace no válido</h1>
                    <p class="text-base-content/70">
                        El enlace de verificación no es válido o ha expirado.<br>
                        Vuelve al formulario de registro y solicita un nuevo correo.
                    </p>
                    <a href="{{ route('register') }}" class="btn btn-outline rounded-full normal-case">
                        Volver al registro
                    </a>
                @endif
            </div>
        </main>

        <x-home-footer />
    </div>
    @fluxScripts
</body>

</html>
