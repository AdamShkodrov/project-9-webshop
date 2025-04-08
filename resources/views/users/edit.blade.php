<!-- Foutmeldingen weergeven -->
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Formulier -->
<form action="/users/update/{{$user->id}}" method="POST">
    @csrf

    <div>
        <label for="name">Naam</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" required>
    </div>

    <div>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Rollen</label>
        <div class="space-y-2 mt-2">
            @foreach ($roles as $role)
            <div class="flex items-center">
                <!-- Check if the user has this role and set the checkbox as checked if true -->
                <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                {{ $users->roles->pluck('id')->contains($role->id) ? 'checked' : '' }}>
                <label for="role_{{ $role->id }}" class="text-gray-800">{{ $role->name }}</label>
            </div>
            @endforeach
        </div>
    </div>

    <button type="submit">
        Opslaan
    </button>
</form>
