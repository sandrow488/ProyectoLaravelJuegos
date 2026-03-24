<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">

                <div class="mb-6 border-b border-gray-200 pb-4">
                    <h1 class="text-xl font-bold text-gray-900">Nuevo Juego</h1>
                    <p class="text-sm text-gray-500 mt-1">Pon un titulo y selecciona el motor disponible en el servidor.</p>
                </div>

                <form method="POST" action="{{ route('admin.games.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="title" value="Titulo del juego" />
                        <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" :value="old('title')" required placeholder="Ej: Space Runner, Neon Dash..." />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" value="Descripcion (opcional)" />
                        <textarea id="description" name="description" rows="3"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                            placeholder="Describe brevemente el juego...">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="image" value="URL de imagen (opcional)" />
                        <x-text-input id="image" name="image" type="text" class="block mt-1 w-full" :value="old('image')" placeholder="/images/runner_thumb.png" />
                        <p class="text-xs text-gray-400 mt-1">Ruta relativa o URL de la imagen de portada del juego.</p>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="url" value="Motor del juego" />
                        <p class="text-xs text-gray-400 mb-1">Selecciona el archivo instalado en el servidor.</p>
                        <select name="url" id="url" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5" required>
                            <option value="">-- Selecciona un motor --</option>
                            @foreach($availableFiles as $path => $label)
                                <option value="{{ $path }}" {{ old('url') == $path ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>

                    <div class="mb-6 flex items-center gap-2">
                        <input type="checkbox" id="published" name="published" value="1" checked class="rounded border-gray-300 text-blue-600 w-4 h-4" />
                        <label for="published" class="text-sm text-gray-700">Publicar en el catalogo</label>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.games.index') }}" class="text-sm text-gray-500 hover:underline">Cancelar</a>
                        <x-primary-button>Crear juego</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
