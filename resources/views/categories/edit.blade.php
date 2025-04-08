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
<form action="/categories/update/{{$category->id}}" method="post">
    @csrf

    <div>
        <label for="name">Naam</label>
        <input type="text" name="name" id="name" value="{{$category->name}}">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Products</label>
        <div class="space-y-2 mt-2">
            @foreach ($products as $product)
            <div class="flex items-center">
                <input type="checkbox" name="product_id[]" value="{{ $product->id }}" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="product_{{ $product->id }}" class="text-gray-800">{{ $product->name }}</label>
            </div>
            @endforeach
        </div>
    </div>
    

    <button type="submit">
        Bewerken
    </button>
</form>
