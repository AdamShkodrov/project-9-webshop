<x-base-layout>
    <div class="text-center mb-6">
        <!-- Centered Heading -->
        <h1 class="text-3xl font-bold text-gray-800">Featured Products</h1>
    </div>

    <!-- Product Listing Section -->
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
            <div class="bg-gray-100 p-4 rounded-lg shadow-md hover:bg-gray-200 transition duration-200 ease-in-out">
                <!-- Wrap the entire product card in an anchor tag to make it clickable -->
                <a href="{{ route('products.detail', $product->id) }}" class="block">

                        <!-- Product Image -->
                        {{-- <img src="https://via.placeholder.com/300" class="w-full h-48 object-cover rounded-t-lg" alt="Product Image"> --}}
        
                        <!-- Product Details -->
                        <div class="card-body mt-4">
                            <h5 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h5>
                            <p class="text-lg text-gray-600 mt-2">€{{ number_format($product->price, 2) }}</p>
        
                            <!-- Add to Cart Button -->
                            <div class="mt-4 flex justify-center">
                                <a href="{{ route('products.addToCart', $product->id) }}" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-200 ease-in-out">
                                    Add to Cart
                                </a>
                            </div>

                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Product 1">
                        <div class="card-body">
                            <a href="{{ route('products.addToCart', $product->id) }}" class="btn btn-primary">Add to Cart</a>
                        </div>
                        
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        
    </div>
    
</x-base-layout>
