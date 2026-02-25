<div class="w-full">
    <form wire:submit="updateProfileInformation" class="space-y-6" novalidate>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nombre --}}
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-bold text-base-content">{{ __('Nombre') }}</span>
                </label>
                <input wire:model.blur="nombre" type="text" placeholder="Tu nombre"
                    class="input input-bordered w-full @error('nombre') input-error @enderror bg-base-100 text-base-content"
                    required autofocus autocomplete="name" />
                @error('nombre')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
                @enderror
            </div>

            {{-- Apellidos --}}
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-bold text-base-content">{{ __('Apellidos') }}</span>
                </label>
                <input wire:model.blur="apellidos" type="text" placeholder="Tus apellidos"
                    class="input input-bordered w-full @error('apellidos') input-error @enderror bg-base-100 text-base-content"
                    required autocomplete="family-name" />
                @error('apellidos')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Teléfono --}}
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-bold text-base-content">{{ __('Teléfono (9 dígitos)') }}</span>
                </label>
                <input wire:model.blur="telefono" type="tel" placeholder="600000000"
                    class="input input-bordered w-full @error('telefono') input-error @enderror bg-base-100 text-base-content"
                    required autocomplete="tel" />
                @error('telefono')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-bold text-base-content">{{ __('Email') }}</span>
                </label>
                <input wire:model.blur="email" type="email" placeholder="email@ejemplo.com"
                    class="input input-bordered w-full @error('email') input-error @enderror bg-base-100 text-base-content"
                    required autocomplete="email" />
                @error('email')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
                @enderror
            </div>
        </div>

        {{-- Dirección --}}
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text font-bold text-base-content">{{ __('Dirección') }}</span>
            </label>
            <input wire:model.blur="direccion" type="text" placeholder="Calle, Número, Ciudad"
                class="input input-bordered w-full @error('direccion') input-error @enderror bg-base-100 text-base-content"
                autocomplete="street-address" />
            @error('direccion')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
            @enderror
        </div>

        {{-- Email Verification Prompt --}}
        @if ($this->hasUnverifiedEmail)
        <div class="alert alert-warning shadow-sm py-3 px-4 rounded-xl flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span class="text-sm font-medium">{{ __('Your email address is unverified.') }}</span>
            </div>
            <button type="button" class="btn btn-xs btn-outline" wire:click="resendVerificationNotification">
                {{ __('Resend Email') }}
            </button>
        </div>

        @if (session('status') === 'verification-link-sent')
        <div class="mt-2 text-sm font-medium text-success text-center">
            {{ __('A new verification link has been sent to your email address.') }}
        </div>
        @endif
        @endif

        {{-- Action Buttons --}}
        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="btn btn-primary px-8">
                {{ __('Guardar Datos') }}
            </button>

            <x-action-message class="text-success font-medium" on="profile-updated">
                {{ __('¡Datos guardados!') }}
            </x-action-message>
        </div>
    </form>

    @if ($this->showDeleteUser)
    <div class="mt-12 pt-8 border-t border-base-300">
        <livewire:settings.delete-user-form />
    </div>
    @endif
</div>