<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
    <livewire:navbar />
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="max-w-5xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-center mb-10">Información Legal</h1>

        <!-- Radios (ocultos) -->
        <input type="radio" name="tabs" id="tab-terms" checked class="hidden peer/terms">
        <input type="radio" name="tabs" id="tab-privacy" class="hidden peer/privacy">
        <input type="radio" name="tabs" id="tab-legal" class="hidden peer/legal">

        <!-- Botones -->
        <div class="flex justify-center gap-4 mb-8">
            <label for="tab-terms" class="cursor-pointer px-5 py-2 rounded-lg font-medium
                   bg-gray-200 peer-checked/terms:bg-gray-900 peer-checked/terms:text-white">
                Términos y Condiciones
            </label>

            <label for="tab-privacy" class="cursor-pointer px-5 py-2 rounded-lg font-medium
                   bg-gray-200 peer-checked/privacy:bg-gray-900 peer-checked/privacy:text-white">
                Política de Privacidad
            </label>

            <label for="tab-legal" class="cursor-pointer px-5 py-2 rounded-lg font-medium
                   bg-gray-200 peer-checked/legal:bg-gray-900 peer-checked/legal:text-white">
                Aviso Legal
            </label>
        </div>

        <!-- CONTENIDOS -->

        <!-- TÉRMINOS -->
        <section class="hidden peer-checked/terms:block bg-white p-8 rounded-xl shadow">
            <h2 class="text-2xl font-bold mb-4">Términos y Condiciones de Uso</h2>

            <p class="mb-6">
                El presente documento regula el acceso y uso del sitio web y de los servicios ofrecidos por
                <strong>MakeThis</strong>. Al navegar por este sitio o utilizar sus servicios, el usuario acepta
                plenamente los términos y condiciones aquí descritos.
            </p>

            <h3 class="text-xl font-semibold mt-6 mb-2">1. Información General</h3>
            <ul class="list-disc list-inside mb-4">
                <li><strong>Titular:</strong> MakeThis</li>
                <li><strong>Dirección fiscal:</strong> Paseo de la Castellana, 259, 28046 Madrid, España</li>
                <li><strong>Email:</strong> MakeThis@gmail.com</li>
                <li><strong>Atención al cliente:</strong> Assistance@email.com</li>
            </ul>

            <h3 class="text-xl font-semibold mt-6 mb-2">2. Objeto</h3>
            <p class="mb-4">
                MakeThis ofrece servicios de diseño, escaneado 3D, modelado digital, fresado y fabricación de
                piezas personalizadas.
            </p>

            <h3 class="text-xl font-semibold mt-6 mb-2">3. Condiciones de Uso</h3>
            <p class="mb-4">
                El usuario se compromete a utilizar el sitio web de forma lícita y responsable.
            </p>

            <h3 class="text-xl font-semibold mt-6 mb-2">4. Propiedad Intelectual</h3>
            <p class="mb-4">
                Todos los contenidos del sitio web son propiedad de MakeThis o de terceros autorizados.
            </p>

            <h3 class="text-xl font-semibold mt-6 mb-2">5. Legislación Aplicable</h3>
            <p>
                Las presentes condiciones se rigen por la legislación española.
            </p>

            <p class="mt-8 text-sm text-gray-500">
                © 2026 MakeThis. Todos los derechos reservados.
            </p>
        </section>

        <!-- PRIVACIDAD -->
        <section class="hidden peer-checked/privacy:block bg-white p-8 rounded-xl shadow">
            <h2 class="text-2xl font-bold mb-4">Política de Privacidad</h2>

            <p class="mb-6">
                MakeThis se compromete a proteger la privacidad y los datos personales de los usuarios.
            </p>

            <h3 class="text-xl font-semibold mt-6 mb-2">1. Responsable del tratamiento</h3>
            <ul class="list-disc list-inside mb-4">
                <li><strong>Responsable:</strong> MakeThis</li>
                <li><strong>Dirección:</strong> Paseo de la Castellana, 259, 28046 Madrid, España</li>
                <li><strong>Email:</strong> MakeThis@gmail.com</li>
                <li><strong>Atención al cliente:</strong> Assistance@email.com</li>
            </ul>

            <h3 class="text-xl font-semibold mt-6 mb-2">2. Datos recogidos</h3>
            <ul class="list-disc list-inside mb-4">
                <li>Nombre y apellidos</li>
                <li>Correo electrónico</li>
                <li>Información facilitada voluntariamente</li>
            </ul>

            <h3 class="text-xl font-semibold mt-6 mb-2">3. Derechos del usuario</h3>
            <p>
                El usuario puede ejercer sus derechos enviando un correo a
                <strong>MakeThis@gmail.com</strong>.
            </p>
        </section>

        <!-- AVISO LEGAL -->
        <section class="hidden peer-checked/legal:block bg-white p-8 rounded-xl shadow">
            <h2 class="text-2xl font-bold mb-4">Aviso Legal</h2>

            <h3 class="text-xl font-semibold mt-6 mb-2">1. Información General</h3>
            <ul class="list-disc list-inside mb-4">
                <li><strong>Titular:</strong> MakeThis</li>
                <li><strong>Dirección fiscal:</strong> Paseo de la Castellana, 259, 28046 Madrid, España</li>
                <li><strong>Email:</strong> MakeThis@gmail.com</li>
                <li><strong>Atención al cliente:</strong> Assistance@email.com</li>
            </ul>

            <h3 class="text-xl font-semibold mt-6 mb-2">2. Uso del sitio web</h3>
            <p>
                El acceso al sitio web implica la aceptación del presente Aviso Legal.
            </p>

            <h3 class="text-xl font-semibold mt-6 mb-2">3. Legislación</h3>
            <p>
                El presente Aviso Legal se rige por la legislación española.
            </p>
        </section>

    </div>
    <livewire:footer />
    @fluxScripts
</body>

</html>