<x-base-layout>
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Gebruikers</h1>
    <table class="min-w-full table-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <div class="mb-6 text-center">
            <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-200 ease-in-out">
                Nieuwe user aanmaken
            </a>
        </div>

        <thead class="bg-gray-200 text-gray-800">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold">#</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Naam</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Rol</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Acties</th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50 transition duration-300">
                <td class="px-6 py-4 text-sm">{{ $user->id }}</td>
                <td class="px-6 py-4 text-sm">{{ $user->name }}</td>
                <td class="px-6 py-4 text-sm">{{ $user->email }}</td>
                <td class="px-6 py-4 text-sm">
                    @foreach ($user->roles as $role)
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-1 rounded-full mr-2">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td class="px-6 py-4 text-sm">
                    <a href="{{ route('users.show', $user->id) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200 ease-in-out mr-2">Bekijken</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition duration-200 ease-in-out mr-2">Bewerken</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-200 ease-in-out" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">Verwijderen</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-base-layout>