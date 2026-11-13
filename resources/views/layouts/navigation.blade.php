<nav x-data="{ open: false }" class="border-b border-zinc-800 bg-zinc-950">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <!-- Lado Esquerdo: Logo e Links de Navegação -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logoT class="h-40 w-auto mb-28 mt-2" />
                    </a>
                </div>

                @auth
                    <!-- Navigation Links (Desktop) - Apenas para Admin -->
                    @if(auth()->user()->role === 'admin')     
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-zinc-300 hover:text-white">
                                <x-lucide-chart-no-axes-combined class="w-4 h-4 me-2" />
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            
                            <x-nav-link :href="Route::has('pessoas.index') ? route('pessoas.index') : '#'" :active="request()->routeIs('pessoas*')" class="text-zinc-300 hover:text-white">
                                <x-lucide-user class="w-4 h-4 me-2" />
                                {{ __('Pessoas') }}
                            </x-nav-link>
                            
                            <x-nav-link :href="route('aulas.index')" :active="request()->routeIs('aulas.*')" class="text-zinc-300 hover:text-white">
                                <x-lucide-dumbbell class="w-4 h-4 me-2" />
                                {{ __('Aulas') }}
                            </x-nav-link>

                            <x-nav-link :href="Route::has('matriculas.index') ? route('matriculas.index') : '#'" :active="request()->routeIs('matriculas*')" class="text-zinc-300 hover:text-white">
                                <x-lucide-clipboard-check class="w-4 h-4 me-2" />
                                {{ __('navigation.matriculas') }}
                            </x-nav-link>

                            <x-nav-link :href="Route::has('relatorios.index') ? route('relatorios.index') : '#'" :active="request()->routeIs('relatorios*')" class="text-zinc-300 hover:text-white">
                                <x-lucide-scroll-text class="w-4 h-4 me-2" />
                                {{ __('navigation.relatorios') }}
                            </x-nav-link>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Lado Direito: Seletor de Idioma + Perfil / Login (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                
                <!-- Dropdown de Idioma (Sleek Dark com Indicador Ativo) -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 border border-zinc-800 text-sm font-medium rounded-md text-zinc-300 bg-zinc-800/60 hover:text-white hover:bg-zinc-800 focus:outline-none transition ease-in-out duration-150">
                            <x-flag-icon :code="app()->getLocale()" />
                            <span class="uppercase font-semibold">{{ app()->getLocale() }}</span>
                            <svg class="fill-current h-4 w-4 text-zinc-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @foreach (config('localization.locales') as $code => $name)
                            @php
                                $isActive = app()->getLocale() === $code;
                            @endphp

                            <x-dropdown-link :href="route('locale', $code)" class="flex items-center justify-between gap-2 {{ $isActive ? 'bg-zinc-800/80 text-zinc-100 font-semibold' : 'text-zinc-400' }}">
                                <div class="flex items-center gap-2.5">
                                    <x-flag-icon :code="$code" />
                                    <span>{{ $name }}</span>
                                </div>

                                @if ($isActive)
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                @endif
                            </x-dropdown-link>
                        @endforeach
                    </x-slot>
                </x-dropdown>

                <!-- Área de Autenticação / Visitante -->
                @auth
                    <!-- Settings Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-zinc-300 bg-zinc-800 hover:text-white hover:bg-zinc-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Sair') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-3 ms-2">
                        <a href="{{ route('login') }}" class="inline-block px-4 py-1.5 text-zinc-300 hover:text-white text-sm font-medium transition">
                            {{ __('Log in') }}
                        </a>
                        <a href="{{ route('register') }}" class="inline-block px-4 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-md text-sm font-medium transition">
                            {{ __('Register') }}
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-zinc-400 hover:text-white hover:bg-zinc-800 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-zinc-900 border-t border-zinc-800">
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-zinc-300">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="Route::has('pessoas.index') ? route('pessoas.index') : '#'" :active="request()->routeIs('pessoas*')"  class="text-zinc-300">
                        {{ __('Pessoas') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('aulas.index')" :active="request()->routeIs('aulas*')" class="text-zinc-300">
                        {{ __('Aulas') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="Route::has('matriculas.index') ? route('matriculas.index') : '#'" :active="request()->routeIs('matriculas*')" class="text-zinc-300">
                        {{ __('navigation.matriculas') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="Route::has('relatorios.index') ? route('relatorios.index') : '#'" :active="request()->routeIs('relatorios*')" class="text-zinc-300">
                        {{ __('navigation.relatorios') }}
                    </x-responsive-nav-link>


                </div>
            @endif

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-zinc-800">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-zinc-400">{{ Auth::user()->email }}</div>
                </div>

<div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-zinc-300">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-zinc-300">
                            {{ __('Sair') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('login')" class="text-zinc-300">
                    {{ __('Log in') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" class="text-zinc-300">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            </div>
        @endauth

        <!-- Idioma no Menu Mobile -->
        <div class="pt-4 pb-4 border-t border-zinc-800 px-4">
            <div class="text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-2">{{ __('Idioma') }}</div>
            <div class="flex gap-2">
                @foreach (config('localization.locales') as $code => $name)
                    @php $isActive = app()->getLocale() === $code; @endphp
                    <a href="{{ route('locale', $code) }}" class="px-3 py-1.5 text-sm rounded-md border {{ $isActive ? 'bg-zinc-800 text-white border-zinc-700 font-semibold' : 'text-zinc-400 border-zinc-800 hover:bg-zinc-800/50' }}">
                        {{ strtoupper($code) }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</nav>