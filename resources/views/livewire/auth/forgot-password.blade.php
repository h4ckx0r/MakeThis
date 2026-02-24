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
        <a href="{{ route('login') }}" class="absolute top-8 left-8 text-2xl hover:opacity-70 transition-opacity">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>

        <div class="w-full max-w-md space-y-8">
            {{-- Logo centrado --}}
            <div class="flex justify-center">
                <div class="flex h-24 w-24 items-center justify-center rounded-xl bg-base-200 shadow-sm">
                    <x-app-logo-icon class="size-16 fill-current text-black dark:text-white" />
                </div>
            </div>

            {{-- Título --}}
            <div class="text-center">
                <h1 class="text-2xl font-semibold">
                    ¿HAS OLVIDADO TU CONTRASEÑA?
                </h1>
                <p class="text-sm mt-2 opacity-70">
                    Introduce tu email y te enviaremos un código de verificación.
                </p>
            </div>

            {{-- Estado de mensaje --}}
            @if (session('status'))
                <div class="text-center font-medium text-sm text-success">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="text-center font-medium text-sm text-error">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Formulario --}}
            <form wire:submit="sendOtp" class="space-y-6">
                {{-- Campo Email --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-[15px] font-normal" style="margin-bottom: 10px">Email</span>
                    </label>
                    <input
                        type="email"
                        wire:model="email"
                        placeholder="ejemplo@correo.com"
                        class="input input-bordered rounded-full w-full h-14"
                        required
                        autofocus
                    />
                    @error('email') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Botón Enviar código --}}
                <button type="submit" class="btn btn-primary rounded-full w-full h-14 normal-case text-[15px] font-normal">
                    <span wire:loading.remove wire:target="sendOtp">ENVIAR CÓDIGO</span>
                    <span wire:loading wire:target="sendOtp" class="loading loading-spinner loading-sm"></span>
                </button>
            </form>
        </div>
    </main>

    {{-- Footer --}}
    <x-home-footer />
</div>
