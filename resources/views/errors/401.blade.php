<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>401 - No autorizado</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex flex-col bg-base-100">
    <main class="flex-1 flex items-center justify-center px-6 py-12">
        <div class="text-center space-y-6">
            <div class="flex justify-center">
                <div class="flex h-24 w-24 items-center justify-center rounded-xl bg-base-200 shadow-sm">
                    <x-app-logo-icon class="size-16 fill-current text-black dark:text-white" />
                </div>
            </div>

            <h1 class="text-8xl font-bold text-warning">401</h1>
            <h2 class="text-2xl font-semibold">No autorizado</h2>
            <p class="text-base opacity-70 max-w-md mx-auto">
                Debes iniciar sesión para acceder a esta página.
            </p>

            <a href="/" class="btn btn-primary rounded-full normal-case text-[15px] font-normal px-8 h-13.25">
                Volver al inicio
            </a>
        </div>
    </main>
</body>
</html>
