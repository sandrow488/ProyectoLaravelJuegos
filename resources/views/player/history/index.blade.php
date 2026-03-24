<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-end justify-between mb-6 border-b border-gray-200 pb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Historial de Partidas</h1>
                    <p class="text-gray-500 text-sm mt-1">Todas las partidas guardadas en la plataforma.</p>
                </div>
                <span class="text-sm font-semibold text-gray-600">{{ $sessions->count() }} partidas</span>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-5 py-3 font-semibold text-gray-600">Juego</th>
                            <th class="px-5 py-3 font-semibold text-gray-600 text-center">Puntuacion</th>
                            <th class="px-5 py-3 font-semibold text-gray-600">Jugador</th>
                            <th class="px-5 py-3 font-semibold text-gray-600 text-right">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($sessions as $session)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3 font-medium text-gray-800">{{ $session->game->title }}</td>
                            <td class="px-5 py-3 text-center">
                                <span class="bg-blue-600 text-white px-3 py-1 rounded text-xs font-bold">
                                    {{ $session->result ?? 0 }} pts
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <span class="text-gray-700 font-medium">{{ $session->user->name ?? 'Usuario' }}</span>
                                <br>
                                <span class="text-xs text-gray-400">{{ $session->user->email ?? '' }}</span>
                            </td>
                            <td class="px-5 py-3 text-right text-gray-500">
                                {{ $session->ended_at ? $session->ended_at->format('d/m/Y H:i') : $session->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center text-gray-400">
                                Todavia no has guardado ninguna partida. Juega y pulsa "Guardar Record" al finalizar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
