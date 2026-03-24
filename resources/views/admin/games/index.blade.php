<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6 border-b border-gray-200 pb-4">
                <h1 class="text-2xl font-bold text-gray-900">Gestion de Juegos</h1>
                <a href="{{ route('admin.games.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-blue-700 transition-colors">
                    + Nuevo juego
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-5 py-3 font-semibold text-gray-600">Titulo</th>
                            <th class="px-5 py-3 font-semibold text-gray-600">Archivo</th>
                            <th class="px-5 py-3 font-semibold text-gray-600 text-center">Sesiones</th>
                            <th class="px-5 py-3 font-semibold text-gray-600 text-center">Estado</th>
                            <th class="px-5 py-3 font-semibold text-gray-600 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($games as $game)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3">
                                <span class="font-medium text-gray-800">{{ $game->title }}</span>
                                @if($game->description)
                                    <p class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ $game->description }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <code class="text-xs bg-gray-100 px-2 py-1 rounded text-gray-600">{{ $game->url }}</code>
                            </td>
                            <td class="px-5 py-3 text-center font-medium text-gray-700">{{ $game->sessions_count }}</td>
                            <td class="px-5 py-3 text-center">
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $game->published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $game->published ? 'Publicado' : 'Oculto' }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-right flex justify-end gap-3">
                                <a href="{{ route('admin.games.edit', $game) }}" class="text-blue-600 hover:text-blue-800 font-medium">Editar</a>
                                <form action="{{ route('admin.games.destroy', $game) }}" method="POST" onsubmit="return confirm('Eliminar este juego?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Borrar</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-gray-400">No hay juegos aun. Crea el primero.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:underline">&larr; Volver a usuarios</a>
            </div>

        </div>
    </div>
</x-app-layout>
