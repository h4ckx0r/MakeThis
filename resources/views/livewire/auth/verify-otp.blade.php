<x-layouts::home title="Verificar Código de Recuperación">
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
        <a href="{{ route('password.request') }}" class="absolute top-8 left-8 text-2xl hover:opacity-70 transition-opacity">
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
                <h1 class="text-2xl font-semibold">VERIFICAR CÓDIGO</h1>
                <p class="text-sm mt-2 opacity-70">
                    Introduce el código de 6 dígitos enviado a <strong>{{ $email }}</strong>
                </p>
            </div>

            {{-- Estado de mensaje --}}
            @if ($statusMessage)
                <div class="text-center font-medium text-sm text-success">
                    {{ $statusMessage }}
                </div>
            @endif

            {{-- Formulario de código --}}
            <form wire:submit="verifyOtp" class="space-y-6" x-data="otpInput()">
                <div class="flex justify-center gap-3">
                    <template x-for="(digit, index) in digits" :key="index">
                        <input
                            type="text"
                            maxlength="1"
                            inputmode="numeric"
                            pattern="[0-9]"
                            class="input input-bordered w-12 h-14 text-center text-xl font-bold rounded-lg"
                            x-model="digits[index]"
                            x-on:input="handleInput($event, index)"
                            x-on:keydown.backspace="handleBackspace($event, index)"
                            x-on:paste.prevent="handlePaste($event)"
                            :x-ref="'digit' + index"
                        />
                    </template>
                </div>
                <input type="hidden" x-bind:value="digits.join('')" x-init="$watch('digits', () => $wire.set('code', digits.join('')))" />
                @error('code') <span class="text-error text-sm text-center block">{{ $message }}</span> @enderror

                <button type="submit" class="btn btn-primary rounded-full w-full h-14 normal-case text-[15px] font-normal">
                    <span wire:loading.remove wire:target="verifyOtp">VERIFICAR</span>
                    <span wire:loading wire:target="verifyOtp" class="loading loading-spinner loading-sm"></span>
                </button>
            </form>

            {{-- Reenviar código --}}
            <div class="text-center">
                <button type="button" wire:click="resendOtp" class="text-[15px] font-normal underline hover:text-primary">
                    <span wire:loading.remove wire:target="resendOtp">Reenviar código</span>
                    <span wire:loading wire:target="resendOtp" class="loading loading-spinner loading-xs"></span>
                </button>
            </div>
        </div>
    </main>
</div>


<script>
function otpInput() {
    return {
        digits: ['', '', '', '', '', ''],
        handleInput(event, index) {
            const value = event.target.value;
            if (!/^\d$/.test(value)) {
                this.digits[index] = '';
                return;
            }
            if (index < 5) {
                this.$nextTick(() => {
                    const inputs = event.target.closest('.flex').querySelectorAll('input[type="text"]');
                    if (inputs[index + 1]) inputs[index + 1].focus();
                });
            }
        },
        handleBackspace(event, index) {
            if (this.digits[index] === '' && index > 0) {
                this.$nextTick(() => {
                    const inputs = event.target.closest('.flex').querySelectorAll('input[type="text"]');
                    if (inputs[index - 1]) inputs[index - 1].focus();
                });
            }
        },
        handlePaste(event) {
            const paste = event.clipboardData.getData('text').replace(/\D/g, '').slice(0, 6);
            for (let i = 0; i < 6; i++) {
                this.digits[i] = paste[i] || '';
            }
        }
    };
}
</script>
</x-layouts::home>
