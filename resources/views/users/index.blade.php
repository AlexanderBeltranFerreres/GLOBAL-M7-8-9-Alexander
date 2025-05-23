<x-layout>
    <div class="max-w-7xl mx-auto p-6">

        <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Llista d'Usuaris</h1>

        <form method="GET" action="{{ route('users.index') }}" role="search" aria-label="Cerca usuaris" class="max-w-md mx-auto mb-6">
            <div class="relative">
                <input
                    type="search"
                    name="search"
                    class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="Cerca un usuari..."
                    value="{{ request('search') }}"
                    aria-label="Cerca un usuari"
                >
                <button type="submit" aria-label="Buscar" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600 hover:text-blue-600">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </form>

        @if($users->isEmpty())
            <p class="text-center text-gray-500 text-lg">No s'han trobat usuaris.</p>
        @else
            <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach($users as $user)
                    <div tabindex="0" aria-label="Usuari {{ $user->name }}"
                         class="bg-white rounded-lg shadow-md p-4 flex items-center space-x-4 cursor-pointer hover:shadow-lg transition"
                         onclick="window.location='{{ route('users.show', $user->id) }}'"
                         onkeypress="if(event.key === 'Enter') window.location='{{ route('users.show', $user->id) }}'">

                        <div class="w-16 h-16 rounded-full overflow-hidden flex items-center justify-center bg-gray-300 text-white font-bold text-xl shrink-0">
                            @if($user->profile_photo_url)
                                <img src="{{ $user->profile_photo_url }}" alt="Foto de perfil de {{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            @endif
                        </div>

                        <div class="flex flex-col flex-grow">
                            <h5 class="text-lg font-semibold text-gray-800 truncate" title="{{ $user->name }}">{{ $user->name }}</h5>
                            <p class="text-gray-600 text-sm truncate" title="{{ $user->email }}">{{ $user->email }}</p>
                            <a href="{{ route('users.show', $user->id) }}" class="mt-2 inline-block text-blue-600 hover:text-blue-800 font-semibold text-sm" aria-label="Veure detall de {{ $user->name }}">
                                Veure Detall
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $users->links() }}
            </div>
        @endif

    </div>
</x-layout>
