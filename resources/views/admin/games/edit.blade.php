<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">

                <div class="mb-6 border-b border-gray-200 pb-4">
                    <h1 class="text-xl font-bold text-gray-900">Editar Juego</h1>
                    <p class="text-sm text-gray-500 mt-1">Editando: <strong>{{ $game->title }}</strong></p>
                </div>

                <form method="POST" action="{{ route('admin.games.update', $game) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="title" value="Titulo del juego" />
                        <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" :value="$game->title" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" value="Descripcion" />
                        <textarea id="description" name="description" rows="3"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">{{ $game->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="url" value="Motor del juego" />
                        <select name="url" id="url" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5" required>
                            @foreach($availableFiles as $path => $label)
                                <option value="{{ $path }}" {{ $game->url === $path ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6 flex items-center gap-2">
                        <input type="checkbox" id="published" name="published" value="1" {{ $game->published ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 w-4 h-4" />
                        <label for="published" class="text-sm text-gray-700">Visible en el catalogo</label>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.games.index') }}" class="text-sm text-gray-500 hover:underline">Cancelar</a>
                        <x-primary-button>Guardar cambios</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
