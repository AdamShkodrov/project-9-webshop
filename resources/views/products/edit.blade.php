
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
    <form action="/products/update/{{$product->id}}" method="post">
        @csrf

        <div>
            <label for="name">Naam</label>
            <input type="text" name="name" id="name" value="{{$product->name}}">
        </div>

        <div>
            <label for="description">Beschrijving</label>
            <input type="text" name="description" id="description" value="{{$product->description}}">
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
            <div class="space-y-2 mt-2">
                @foreach ($categories as $category)
                <div class="flex items-center">
                    <input type="checkbox" name="category_id[]" value="{{ $category->id }}" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="category_{{ $category->id }}" class="text-gray-800">{{ $category->name }}</label>
                </div>
                @endforeach
            </div>
        </div>
        

        <button type="submit">
            Bewerken
        </button>
    </form>

