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
        <div class="w-full max-w-md space-y-8">
            {{-- Logo centrado --}}
            <div class="flex justify-center">
                <div class="flex h-24 w-24 items-center justify-center rounded-xl bg-base-200 shadow-sm">
                    <x-app-logo-icon class="size-16 fill-current text-black dark:text-white" />
                </div>
            </div>

            {{-- Título --}}
            <div class="text-center">
                <h1 class="text-2xl font-semibold">NUEVA CONTRASEÑA</h1>
                <p class="text-sm mt-2 opacity-70">
                    Introduce tu nueva contraseña.
                </p>
            </div>

            {{-- Formulario --}}
            <form wire:submit="resetPassword" class="space-y-4">
                {{-- Nueva contraseña --}}
                <div class="relative" x-data="{ show: false }">
                    <input x-bind:type="show ? 'text' : 'password'" wire:model="password"
                        placeholder="Nueva contraseña (mín. 8 caracteres)"
                        class="input input-bordered rounded-lg w-full h-13.25 text-[15px] font-normal pr-12"
                        minlength="8" required autofocus />
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

                {{-- Confirmar contraseña --}}
                <div class="relative" x-data="{ show: false }">
                    <input x-bind:type="show ? 'text' : 'password'" wire:model="password_confirmation"
                        placeholder="Confirmar nueva contraseña"
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

                {{-- Botón --}}
                <button type="submit"
                    class="btn btn-primary rounded-full w-full h-13.25 normal-case text-[15px] font-normal mt-6">
                    <span wire:loading.remove wire:target="resetPassword">CAMBIAR CONTRASEÑA</span>
                    <span wire:loading wire:target="resetPassword" class="loading loading-spinner loading-sm"></span>
                </button>
            </form>
        </div>
    </main>

    {{-- Footer --}}
    <x-home-footer />
</div>
