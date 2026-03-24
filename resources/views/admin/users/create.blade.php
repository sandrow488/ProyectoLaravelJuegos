<x-guest-layout>
    <div class="mb-4 border-b border-gray-200 pb-4">
        <h1 class="text-xl font-bold text-gray-900">Nuevo Usuario</h1>
        <p class="text-sm text-gray-500 mt-1">Rellena los datos para crear una cuenta nueva.</p>
    </div>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="mb-4">
            <x-input-label for="name" value="Nombre" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="email" value="Correo electronico" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="role_id" value="Rol" />
            <select name="role_id" id="role_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->label ?? $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <x-input-label for="password" value="Contrasena" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:underline">Cancelar</a>
            <x-primary-button>Crear usuario</x-primary-button>
        </div>
    </form>
</x-guest-layout>
