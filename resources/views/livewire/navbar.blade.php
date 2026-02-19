<div class="fixed top-6 left-1/2 z-50 w-[calc(100%-3rem)] max-w-4xl -translate-x-1/2 drop-shadow-2xl">
    <header
        class="flex h-16 w-full items-center justify-between rounded-full bg-black px-4 sm:px-8 ring-1 ring-white/10">
        {{-- Logo Section --}}
        <div class="flex items-center gap-4 sm:gap-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2 transition-transform hover:scale-105"
                wire:navigate>
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white shadow-inner">
                    <x-app-logo-icon class="size-6 text-black" />
                </div>
                <span class="hidden font-bold tracking-tight text-white lg:block text-lg">MakeThis</span>
            </a>

            {{-- Navigation Links --}}
            <nav class="flex items-center">
                <a href="{{ route('prints.catalog') }}" wire:navigate
                    class="px-3 sm:px-4 py-2 text-sm font-medium transition-colors rounded-full {{ request()->routeIs('prints.catalog') ? 'text-celeste bg-white/10' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                    {{ __('Catálogo') }}
                </a>
                <a href="{{ route('prints.request') }}" wire:navigate
                    class="px-3 sm:px-4 py-2 text-sm font-medium transition-colors rounded-full {{ request()->routeIs('prints.request') ? 'text-celeste bg-white/10' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                    {{ __('Solicitar Pieza') }}
                </a>
            </nav>
        </div>

        {{-- Right Side / Account --}}
        <div class="flex items-center">
            @auth
            <flux:dropdown position="bottom" align="end">
                <button
                    class="flex items-center gap-2 rounded-full bg-white/10 p-1 pr-3 transition-colors hover:bg-white/20">
                    <flux:avatar :initials="auth()->user()->initials()" size="sm" class="bg-celeste! text-black! rounded-full!" />
                    <span class="hidden text-sm font-medium text-white sm:block">{{ auth()->user()->nombre }}</span>
                    <flux:icon.chevron-down class="size-3 text-white/50" />
                </button>

                <flux:menu class="bg-zinc-900! border-white/10! text-white!">
                    <flux:menu.item :href="auth()->user()->isAdmin ? route('admin.reports') : route('client.requests')"
                        wire:navigate class="active:bg-celeste! active:text-black!">
                        @if(auth()->user()->isAdmin)
                        {{ __('Panel de Control') }}
                        @else
                        {{ __('Mis Solicitudes') }}
                        @endif
                    </flux:menu.item>
                    <flux:menu.item :href="route('profile.edit')" wire:navigate
                        class="active:bg-celeste! active:text-black!">{{ __('Ajustes') }}</flux:menu.item>

                    <flux:menu.separator class="bg-white/10!" />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit"
                            class="w-full text-start active:bg-celeste! active:text-black!">
                            {{ __('Cerrar sesión') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
            @else
            <flux:dropdown position="bottom" align="end">
                <button
                    class="flex items-center gap-2 rounded-full border border-celeste/30 bg-celeste/10 px-4 sm:px-6 py-2 text-sm font-bold text-celeste transition-all hover:bg-celeste hover:text-black shadow-[0_0_15px_rgba(135,206,235,0.3)]">
                    {{ __('Mi cuenta') }}
                    <flux:icon.chevron-down class="size-3" />
                </button>

                <flux:menu class="bg-zinc-900! border-white/10! text-white!">
                    <flux:menu.item :href="route('auth.login')" wire:navigate
                        class="active:bg-celeste! text-white! hover:text-black! active:text-black!">{{ __('Iniciar sesión') }}</flux:menu.item>
                    <flux:menu.item :href="route('auth.register')" wire:navigate
                        class="active:bg-celeste! text-white! hover:text-black! active:text-black!">{{ __('Registrarse') }}</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
            @endauth
        </div>
    </header>
</div>
