<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>417 - Error en la solicitud</title>
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

            <h1 class="text-8xl font-bold text-error">417</h1>
            <h2 class="text-2xl font-semibold">Error en la solicitud</h2>
            <p class="text-base opacity-70 max-w-md mx-auto">
                La solicitud no pudo ser procesada. Inténtalo de nuevo.
            </p>

            <a href="/" class="btn btn-primary rounded-full normal-case text-[15px] font-normal px-8 h-13.25">
                Volver al inicio
            </a>
        </div>
    </main>
</body>
</html>
