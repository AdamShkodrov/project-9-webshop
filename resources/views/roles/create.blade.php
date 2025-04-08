
<div class="container">
    <h1>Maak een rol aan</h1>
   
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Rol Naam</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="voer de rol naam in" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Rol</button>
    </form>
</div>
