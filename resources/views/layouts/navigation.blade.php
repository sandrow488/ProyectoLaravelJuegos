<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center text-gray-900 font-bold text-lg mr-8">
                    <x-application-logo class="block h-7 w-auto text-blue-600 mr-2" />
                    GamePortal
                </a>

                <!-- Links de navegacion -->
                <div class="hidden sm:flex sm:items-center sm:space-x-1">
                    @if(Auth::user()->email === 'admin@plataforma.com' || Auth::user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}"
                        class="px-3 py-1.5 rounded text-sm font-medium transition-colors
                        {{ request()->routeIs('admin.users.*') ? 'bg-red-100 text-red-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Usuarios
                    </a>
                    <a href="{{ route('admin.games.index') }}"
                        class="px-3 py-1.5 rounded text-sm font-medium transition-colors
                        {{ request()->routeIs('admin.games.*') ? 'bg-red-100 text-red-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Gestionar Juegos
                    </a>
                    @endif

                    <a href="{{ route('dashboard') }}"
                        class="px-3 py-1.5 rounded text-sm font-medium transition-colors
                        {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Catalogo
                    </a>

                    <a href="{{ route('player.history.index') }}"
                        class="px-3 py-1.5 rounded text-sm font-medium transition-colors
                        {{ request()->routeIs('player.history.index') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Historial
                    </a>
                </div>
            </div>

            <!-- Usuario / Logout -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            {{ Auth::user()->name }}
                            <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Cerrar sesion
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu movil -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Catalogo</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('player.history.index')" :active="request()->routeIs('player.history.index')">Historial</x-responsive-nav-link>
            @if(Auth::user()->email === 'admin@plataforma.com' || Auth::user()->role === 'admin')
            <x-responsive-nav-link :href="route('admin.users.index')">Usuarios</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.games.index')">Gestionar Juegos</x-responsive-nav-link>
            @endif
        </div>
        <div class="pt-4 pb-2 border-t border-gray-200 px-4">
            <div class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</div>
            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
            <div class="mt-2 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Perfil</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        Cerrar sesion
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
