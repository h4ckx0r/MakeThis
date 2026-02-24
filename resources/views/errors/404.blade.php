<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada</title>
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

            <h1 class="text-8xl font-bold text-warning">404</h1>
            <h2 class="text-2xl font-semibold">Página no encontrada</h2>
            <p class="text-base opacity-70 max-w-md mx-auto">
                La página que buscas no existe o ha sido movida.
            </p>

            <a href="/" class="btn btn-primary rounded-full normal-case text-[15px] font-normal px-8 h-13.25">
                Volver al inicio
            </a>
        </div>
    </main>
</body>
</html>
