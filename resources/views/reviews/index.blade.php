<x-base-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Centered Heading -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Alle Reviews</h1>
        </div>
        
        <!-- Centered Create Review Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('reviews.create') }}" class="inline-block bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Maak een nieuwe review
            </a>
        </div>
        
        <!-- Lijst van reviews -->
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
            <ul class="divide-y divide-gray-200">
                @foreach ($reviews as $review)
                    <li class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <!-- Review Title -->
                            <h2 class="text-lg font-semibold text-gray-900">{{ $review->title }}</h2>
                        </div>

                        <!-- Product Name -->
                        <div class="mt-2 text-gray-600">
                            <strong>Product:</strong> {{ $review->product->name ?? 'No product' }}
                        </div>

                        <!-- Review Content -->
                        <p class="mt-2 text-gray-600">{{ $review->review }}</p>
                        
                        <!-- Review Rating (Stars) -->
                        <p class="mt-2 text-yellow-500">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    &#9733; <!-- Star filled -->
                                @else
                                    &#9734; <!-- Star empty -->
                                @endif
                            @endfor
                        </p>

                        <!-- Action Buttons (Edit and Delete) -->
                        <div class="mt-4 text-right">
                            <!-- Edit Button -->
                            <a href="{{ route('reviews.edit', $review->id) }}" class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                Bewerken
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze review wilt verwijderen?');" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                    Verwijder
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-base-layout>
