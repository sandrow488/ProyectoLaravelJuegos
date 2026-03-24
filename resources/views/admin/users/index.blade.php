<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6 border-b border-gray-200 pb-4">
                <h1 class="text-2xl font-bold text-gray-900">Gestion de Usuarios</h1>
                <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-blue-700 transition-colors">
                    + Nuevo usuario
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-5 py-3 font-semibold text-gray-600">ID</th>
                            <th class="px-5 py-3 font-semibold text-gray-600">Nombre / Email</th>
                            <th class="px-5 py-3 font-semibold text-gray-600 text-center">Rol</th>
                            <th class="px-5 py-3 font-semibold text-gray-600 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3 text-gray-400 font-mono">#{{ $user->id }}</td>
                            <td class="px-5 py-3">
                                <span class="font-medium text-gray-800">{{ $user->name }}</span><br>
                                <span class="text-xs text-gray-400">{{ $user->email }}</span>
                            </td>
                            <td class="px-5 py-3 text-center">
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    {{ optional($user->role)->name === 'admin' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                    {{ optional($user->role)->label ?? optional($user->role)->name ?? 'Sin rol' }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-right flex justify-end gap-3">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800 font-medium">Editar</a>
                                @if($user->email !== 'admin@plataforma.com')
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Eliminar este usuario?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Borrar</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
