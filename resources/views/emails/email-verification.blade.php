<x-mail::message>
# Hola, {{ $nombre }}

Has solicitado verificar tu dirección de correo electrónico para registrarte en **MakeThis**.

Pulsa el botón para confirmar que esta dirección te pertenece:

<x-mail::button :url="$link">
Verificar mi correo
</x-mail::button>

Este enlace expira en **30 minutos**. Si no has solicitado este registro, puedes ignorar este correo.

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
