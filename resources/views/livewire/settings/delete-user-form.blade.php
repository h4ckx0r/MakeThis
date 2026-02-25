<section class="mt-10 space-y-6">
    {{-- Encabezado --}}
    <div class="space-y-1">
        <h3 class="text-lg font-bold text-error">{{ __('Eliminar cuenta') }}</h3>
        <p class="text-sm text-base-content/70">
            {{ __('Una vez que se elimine tu cuenta, todos sus recursos y datos se borrarán de forma permanente.') }}
        </p>
    </div>

    {{-- Botón de disparo --}}
    <button class="btn btn-error" onclick="delete_account_modal.showModal()">
        {{ __('Eliminar cuenta') }}
    </button>

    {{-- Modal de DaisyUI --}}
    <dialog id="delete_account_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <form method="POST" wire:submit="deleteUser" class="space-y-6">
                <h3 class="font-bold text-lg text-error">
                    {{ __('¿Estás seguro de que quieres eliminar tu cuenta?') }}
                </h3>

                <p class="py-4 text-sm text-base-content/70 italic">
                    {{ __('Por favor, introduce tu contraseña para confirmar que deseas eliminar permanentemente tu
                    cuenta.') }}
                </p>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-bold">{{ __('Contraseña') }}</span>
                    </label>
                    <input wire:model="password" type="password"
                        class="input input-bordered w-full @error('password') input-error @enderror bg-base-100"
                        placeholder="Contraseña de confirmación" />
                    @error('password')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                    @enderror
                </div>

                <div class="modal-action">
                    <form method="dialog">
                        <button class="btn btn-ghost">{{ __('Cancelar') }}</button>
                    </form>
                    <button type="submit" class="btn btn-error">
                        {{ __('Eliminar cuenta') }}
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</section>