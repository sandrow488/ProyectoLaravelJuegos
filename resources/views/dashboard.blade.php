<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-indigo-50 via-white to-purple-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Admin Quick Access -->
            @if(Auth::user()->role === 'admin')
            <div class="mb-12 bg-red-600 rounded-3xl p-8 shadow-2xl relative overflow-hidden group border-4 border-red-400/30">
                <div class="absolute top-0 right-0 p-10 opacity-10 transform scale-150 group-hover:rotate-12 transition-transform">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                </div>
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-black text-white tracking-tight">Modo Administrador Activo</h2>
                        <p class="mt-2 text-red-100 text-lg font-medium">Tienes acceso a la gestión global de usuarios, juegos y estadísticas del sistema.</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="mt-6 md:mt-0 bg-white text-red-600 px-8 py-4 rounded-2xl font-black text-xl hover:scale-105 transition-transform shadow-lg shrink-0">
                        Ir a Administración
                    </a>
                </div>
            </div>
            @endif

            <!-- Hero Section -->
            <div class="mb-12">
                <h1 class="text-4xl font-extrabold text-indigo-900 tracking-tight">Panel de Jugador</h1>
                <div class="mt-6 bg-white border border-indigo-100 rounded-3xl p-10 shadow-2xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-indigo-100 rounded-full blur-3xl opacity-50 transition-all group-hover:scale-150 duration-700"></div>
                    <div class="relative z-10">
                        <h2 class="text-3xl font-bold text-gray-800">¡Bienvenido de nuevo, {{ Auth::user()->name }}! 🚀</h2>
                        <p class="mt-3 text-xl text-gray-500 font-medium">¿Listo para una nueva aventura hoy? Elige tu juego favorito y empieza a jugar.</p>
                    </div>
                </div>
            </div>

            <!-- Game Catalog -->
            <div>
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                        Catálogo de Juegos ({{ \App\Models\Game::count() }} disponibles)
                        <span class="ml-4 h-1 w-20 bg-indigo-600 rounded-full"></span>
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                        $games = \App\Models\Game::all(); // Cargamos TODOS para que no falle el filtrado por ahora
                    @endphp

                    @forelse($games as $game)
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                        <div class="h-48 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center relative overflow-hidden">
                            <svg class="h-20 w-20 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 24 24"><path d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-10 7H8v3H6v-3H3v-2h3V8h2v3h3v2zm4.5 2c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4-3c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>
                            
                            <a href="{{ route('player.games.show', $game) }}" class="absolute bottom-4 right-4 bg-gray-900 text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 shadow-lg">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"/></svg>
                            </a>
                        </div>
                        <div class="p-8">
                            <h4 class="text-xl font-bold text-gray-800 mb-2 truncate">{{ $game->title }}</h4>
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 h-10 overflow-hidden">{{ $game->description }}</p>
                            <a href="{{ route('player.games.show', $game) }}" class="flex items-center text-indigo-600 font-bold group-hover:translate-x-2 transition-transform">
                                <span>JUGAR AHORA</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-400 text-lg">No hay juegos disponibles en la base de datos.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
