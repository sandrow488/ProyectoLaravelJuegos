<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-black text-gray-900 mb-8">Administración Global</h1>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 flex items-center">
                    <div class="p-4 bg-indigo-100 text-indigo-600 rounded-2xl mr-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">Usuarios</p>
                        <p class="text-4xl font-black text-gray-800">{{ $stats['total_users'] }}</p>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 flex items-center">
                    <div class="p-4 bg-purple-100 text-purple-600 rounded-2xl mr-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a1 1 0 01-1-1v-3a1 1 0 011-1h1a2 2 0 100-4H4a1 1 0 01-1-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">Juegos</p>
                        <p class="text-4xl font-black text-gray-800">{{ $stats['total_games'] }}</p>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 flex items-center">
                    <div class="p-4 bg-green-100 text-green-600 rounded-2xl mr-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">Sesiones Totales</p>
                        <p class="text-4xl font-black text-gray-800">{{ $stats['total_sessions'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 tracking-tight">Últimas Sesiones Registradas</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Usuario</th>
                                <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Juego</th>
                                <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Puntuación</th>
                                <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Fecha</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($stats['recent_sessions'] as $session)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-8 py-5 font-bold text-gray-700 capitalize">{{ $session->user->name }}</td>
                                <td class="px-8 py-5 text-gray-600">{{ $session->game->title }}</td>
                                <td class="px-8 py-5 text-center">
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full font-black text-sm">
                                        {{ $session->result ?? 0 }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right text-gray-400 text-sm">
                                    {{ $session->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-gray-50 text-center">
                    <a href="#" class="text-indigo-600 font-bold hover:underline">Ver todas las sesiones →</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
