    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('products.store') }}" method="post">
    
        @csrf
        <div>
            <label for="name">Naam</label>
            <input type="text" name="name" id="name">
        </div>
    
        <div>
            <label for="description">Descriptie</label>
            <input type="text" name="description" id="description">
        </div>

        <div>
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock">
        </div>
    
        <div>
            <label for="price">Prijs</label>
            <input type="number" name="price" id="price">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Categories</label>
            <div class="space-y-2">
                @foreach ($categories as $category)
                <div>
                    <label>
                        <input type="checkbox" name="category_id[]" value="{{ $category->id }}" class="mr-2">
                        {{ $category->name }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        
        
    
        <button type="submit">
            Toevoegen
        </button>
    
    </form>
    <br>
    