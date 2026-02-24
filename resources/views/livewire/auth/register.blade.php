<div class="min-h-screen flex flex-col" wire:poll.4000ms="checkVerification">
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
                    REGISTRO
                </h1>
            </div>

            {{-- Formulario --}}
            <form wire:submit="register" class="space-y-4">
                {{-- Campo Nombre --}}
                <input type="text" wire:model="nombre" placeholder="Nombre"
                    class="input input-bordered rounded-lg w-full h-13.25 text-[15px] font-normal" required />
                @error('nombre') <span class="text-error text-sm">{{ $message }}</span> @enderror

                {{-- Campo Apellidos --}}
                <input type="text" wire:model="apellidos" placeholder="Apellidos"
                    class="input input-bordered rounded-lg w-full h-13.25 text-[15px] font-normal" required />
                @error('apellidos') <span class="text-error text-sm">{{ $message }}</span> @enderror

                {{-- Campo Teléfono --}}
                <input type="tel" wire:model="telefono" placeholder="Teléfono"
                    class="input input-bordered rounded-lg w-full h-13.25 text-[15px] font-normal" required />
                @error('telefono') <span class="text-error text-sm">{{ $message }}</span> @enderror

                {{-- Campo Dirección --}}
                <input type="text" wire:model="direccion" placeholder="Dirección"
                    class="input input-bordered rounded-lg w-full h-13.25 text-[15px] font-normal" />
                @error('direccion') <span class="text-error text-sm">{{ $message }}</span> @enderror

                {{-- Campo Email --}}
                <input type="email" wire:model="email" placeholder="Email"
                    class="input input-bordered rounded-lg w-full h-13.25 text-[15px] font-normal"
                    :class="$wire.emailVerified ? 'input-success' : ''"
                    :readonly="$wire.emailVerified" required />
                @error('email') <span class="text-error text-sm">{{ $message }}</span> @enderror

                {{-- Verificación de correo --}}
                <div class="flex items-center gap-3 min-h-8">
                    <button type="button"
                        wire:click="sendVerificationEmail"
                        wire:loading.attr="disabled"
                        wire:target="sendVerificationEmail"
                        x-show="!$wire.emailVerified"
                        class="btn btn-outline btn-sm rounded-full normal-case text-[13px]">
                        <span wire:loading.remove wire:target="sendVerificationEmail">Verificar correo</span>
                        <span wire:loading wire:target="sendVerificationEmail" class="loading loading-spinner loading-xs"></span>
                    </button>

                    @if($verificationStatus === 'sent')
                        <span class="text-info text-sm">Correo enviado. Revisa tu bandeja de entrada.</span>
                    @endif

                    @if($verificationStatus === 'verified')
                        <span class="text-success text-sm flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Correo verificado
                        </span>
                    @endif
                </div>

                {{-- Campo Contraseña --}}
                <div class="relative" x-data="{ show: false }">
                    <input x-bind:type="show ? 'text' : 'password'" wire:model="password"
                        placeholder="Contraseña (mín. 8 caracteres)"
                        class="input input-bordered rounded-lg w-full h-13.25 text-[15px] font-normal pr-12"
                        minlength="8" required />
                    <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2"
                        x-on:click="show = !show">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password') <span class="text-error text-sm">{{ $message }}</span> @enderror

                {{-- Campo Confirmar Contraseña --}}
                <div class="relative" x-data="{ show: false }">
                    <input x-bind:type="show ? 'text' : 'password'" wire:model="password_confirmation"
                        placeholder="Confirmar Contraseña"
                        class="input input-bordered rounded-lg w-full h-13.25 text-[15px] font-normal pr-12"
                        minlength="8" required />
                    <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2"
                        x-on:click="show = !show">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password_confirmation') <span class="text-error text-sm">{{ $message }}</span> @enderror

                {{-- Texto legal --}}
                <div class="text-[15px] font-normal leading-relaxed py-1">
                    Al hacer clic en el botón "Registrarse", aceptas las
                    <a href="{{ route('terms-conditions') }}" class="underline hover:text-primary">Condiciones
                        Generales de Venta</a>
                    y la
                    <a href="{{ route('terms-conditions') }}" class="underline hover:text-primary">Política de
                        Privacidad</a>
                    de MakeThis.
                </div>

                {{-- Cloudflare Turnstile --}}
                {{-- Pre-registrar callback para evitar race condition con Turnstile async --}}
                <script>
                    window.captchaCallback = function(token) {
                        window.__captchaToken = token;
                    };
                </script>
                <div class="flex justify-center">
                    <x-turnstile wire:model="turnstileResponse" />
                </div>
                @error('cf-turnstile-response')
                    <span class="text-error text-sm text-center block">{{ $message }}</span>
                @enderror
                {{-- Sincronizar token pendiente cuando Livewire inicialice --}}
                <script>
                    document.addEventListener('livewire:initialized', () => {
                        if (window.__captchaToken) {
                            @this.set('turnstileResponse', window.__captchaToken);
                            delete window.__captchaToken;
                        }
                    });
                </script>

                {{-- Link iniciar sesión --}}
                <div class="text-center pt-2">
                    <a href="{{ route('login') }}" class="text-[15px] font-normal underline hover:text-primary">
                        ¿Ya tienes una cuenta? Inicia sesión aquí
                    </a>
                </div>

                {{-- Botón Registrarse --}}
                <button type="submit"
                    :disabled="!$wire.emailVerified"
                    :class="!$wire.emailVerified ? 'opacity-50 cursor-not-allowed' : ''"
                    class="btn btn-primary rounded-full w-full h-13.25 normal-case text-[15px] font-normal mt-6">
                    <span wire:loading.remove wire:target="register">REGISTRARSE</span>
                    <span wire:loading wire:target="register" class="loading loading-spinner loading-sm"></span>
                </button>
            </form>
        </div>
    </main>

    {{-- Footer --}}
    <x-home-footer />
</div>
