<x-mail::message>
# Hola, {{ $nombre }}

Has solicitado un código para restablecer tu contraseña en **MakeThis**.

Tu código de verificación es:

<x-mail::panel>
<div style="text-align: center; font-size: 32px; font-weight: bold; letter-spacing: 8px;">
{{ $code }}
</div>
</x-mail::panel>

Este código expira en **10 minutos**. Si no has solicitado este cambio, puedes ignorar este correo.

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
