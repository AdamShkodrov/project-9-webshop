<x-base-layout>
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md mt-6">
        <!-- Product Name -->
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-gray-800">{{ $product->name }}</h1>
        </div>

        <!-- Product Image (optional, you can add an image field to your model) -->
        <div class="flex justify-center mb-6">
            <img src="https://via.placeholder.com/600x400" class="rounded-lg shadow-lg" alt="{{ $product->name }}">
        </div>

        <!-- Product Details -->
        <div class="space-y-4">
            <!-- Description -->
            <p class="text-base text-gray-700 leading-relaxed">{{ $product->description }}</p>

            <!-- Price -->
            <p class="text-lg font-semibold text-gray-800">€{{ number_format($product->price, 2) }}</p>

            <!-- Stock -->
            <p class="text-sm text-gray-600">Stock: {{ $product->stock }} available</p>

            <!-- Categories -->
            @if ($product->categories->count() > 0)
                <div class="text-sm text-gray-600">
                    <p class="font-semibold">Categories:</p>
                    @foreach ($product->categories as $category)
                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full mr-2">{{ $category->name }}</span>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-600">No categories available for this product.</p>
            @endif
        </div>

        <!-- Add to Cart Button -->
        <div class="mt-6 flex justify-center">
            <a href="{{ route('products.addToCart', $product->id) }}" class="bg-blue-500 text-white px-8 py-3 rounded-md hover:bg-blue-600 transition duration-200 ease-in-out">
                Add to Cart
            </a>
        </div>

        <!-- Review Button -->
        <div class="mt-6 flex justify-center">
            <a href="{{ route('reviews.create', ['product' => $product->id]) }}" class="bg-green-500 text-white px-8 py-3 rounded-md hover:bg-green-600 transition duration-200 ease-in-out">
                Write a Review
            </a>
        </div>
    </div>
</x-base-layout>
