<flux:modal name="login-modal" class="max-w-md">
    <div class="space-y-6 p-6">
        {{-- Logo --}}
        <div class="flex justify-center">
            <div class="flex h-16 w-16 items-center justify-center rounded-lg bg-base-200">
                <x-app-logo-icon class="size-10 fill-current text-black dark:text-white" />
            </div>
        </div>

        {{-- Formulario --}}
        <form action="/login" method="POST" class="space-y-4">
            @csrf

            {{-- Campo Email --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input
                    type="email"
                    name="email"
                    placeholder="ejemplo@correo.com"
                    class="input input-bordered w-full"
                    required
                />
            </div>

            {{-- Campo Contraseña --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Contraseña</span>
                </label>
                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    class="input input-bordered w-full"
                    required
                />
            </div>

            {{-- Link Olvidó contraseña --}}
            <div class="flex justify-end">
                <a href="#" class="text-sm text-primary hover:underline">
                    ¿Olvidó contraseña?
                </a>
            </div>

            {{-- Botón Validar --}}
            <div>
                <button type="submit" class="btn btn-primary w-full">
                    Validar
                </button>
            </div>

            {{-- Enlaces adicionales --}}
            <div class="space-y-2 text-center text-sm">
                <div>
                    <a href="#" class="text-primary hover:underline">
                        Ver otras formas de inicio de sesión
                    </a>
                </div>
                <div>
                    <a href="#" class="text-primary hover:underline">
                        Crear una cuenta gratis
                    </a>
                </div>
            </div>
        </form>
    </div>
</flux:modal>