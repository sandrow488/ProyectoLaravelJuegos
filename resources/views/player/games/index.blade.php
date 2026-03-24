<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-end justify-between mb-6 border-b border-gray-200 pb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Catalogo de Juegos</h1>
                    <p class="text-gray-500 text-sm mt-1">Elige un juego para empezar a jugar y sumar puntos.</p>
                </div>
                <span class="text-sm text-gray-400">{{ \App\Models\Game::where('published', true)->count() }} juegos disponibles</span>
            </div>



            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($games as $game)
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="h-36 bg-gray-800 overflow-hidden">
                        <img src="{{ $game->image ?? '/images/runner_thumb.png' }}"
                             alt="{{ $game->title }}"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h2 class="font-bold text-gray-900 text-base mb-1">{{ $game->title }}</h2>
                        <p class="text-gray-500 text-sm mb-4 leading-relaxed">{{ $game->description }}</p>
                        <a href="{{ route('player.games.show', $game) }}" class="block text-center bg-blue-600 text-white py-2 rounded text-sm font-semibold hover:bg-blue-700 transition-colors">
                            Jugar ahora
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-16 text-gray-400">
                    No hay juegos publicados de momento.
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
