<header class="border-b border-base-300">
    <div class="navbar mx-auto max-w-7xl px-6 py-4">
        <div class="flex-1">
            <a href="{{ route('home') }}" class="flex items-center gap-3 text-lg font-semibold" wire:navigate>
                <span class="flex h-10 w-10 items-center justify-center rounded-md bg-base-200">
                    <x-app-logo-icon class="size-10 fill-current text-black dark:text-white" />
                </span>
                <span>MakeThis</span>
            </a>
        </div>
        <div class="flex-none">
            <div class="rounded-full border border-base-300 bg-base-200 px-4 py-2">
                <ul class="menu menu-horizontal gap-2 p-0">
                    <li>
                        <span class="h-6 w-10 rounded-full bg-base-300"></span>
                    </li>
                    @foreach (range(1, 4) as $index)
                        <li>
                            @if ($index === 4)
                                <div class="dropdown dropdown-end">
                                    <button type="button" tabindex="0" class="text-sm font-medium">Mi Cuenta</button>
                                    <div tabindex="0" class="dropdown-content z-1 mt-3 w-80 rounded-lg border border-base-300 bg-base-100 p-6 shadow-xl">
                                        {{-- Logo --}}
                                        <div class="flex justify-center mb-4">
                                            <div class="flex h-16 w-16 items-center justify-center rounded-lg bg-base-200">
                                                <x-app-logo-icon class="size-10 fill-current text-black dark:text-white" />
                                            </div>
                                        </div>

                                        {{-- Formulario --}}
                                        <form action="{{ route('login') }}" method="POST" class="space-y-3">
                                            @csrf

                                            {{-- Campo Email --}}
                                            <div class="form-control">
                                                <label class="label pb-1">
                                                    <span class="label-text text-[12px] font-normal">Email</span>
                                                </label>
                                                <input
                                                    type="email"
                                                    name="email"
                                                    placeholder="ejemplo@correo.com"
                                                    class="input input-bordered rounded-lg w-full h-10 text-sm"
                                                    required
                                                />
                                            </div>

                                            {{-- Campo Contraseña --}}
                                            <div class="form-control">
                                                <label class="label pb-1">
                                                    <span class="label-text text-[12px] font-normal">Contraseña</span>
                                                </label>
                                                <input
                                                    type="password"
                                                    name="password"
                                                    placeholder="••••••••"
                                                    class="input input-bordered rounded-lg w-full h-10 text-sm"
                                                    required
                                                />
                                            </div>

                                            {{-- Link Olvidó contraseña --}}
                                            <div class="flex justify-end">
                                                <a href="{{ route('password.request') }}" class="text-[9px] font-normal underline hover:text-primary">
                                                    ¿Olvidó contraseña?
                                                </a>
                                            </div>

                                            {{-- Botón Validar --}}
                                            <div class="pt-1">
                                                <button type="submit" class="btn btn-primary rounded-lg w-full h-10 normal-case text-[12px] font-normal">
                                                    Validar
                                                </button>
                                            </div>

                                            {{-- Enlaces adicionales --}}
                                            <div class="space-y-1 text-center pt-2">
                                                <div>
                                                    <a href="{{ route('auth.login-options') }}" class="text-[9px] font-normal underline hover:text-primary">
                                                        Ver otras formas de inicio de sesión
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('register') }}" class="text-[9px] font-normal underline hover:text-primary">
                                                        Crear una cuenta gratis
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <a class="text-sm font-medium">Placeholder</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</header>
