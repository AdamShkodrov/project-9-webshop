<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;  // Assuming you have a ReviewRequest similar to CategoryRequest
use App\Models\Review;  // Replaced Category model with Review model
use App\Models\Product; // Assuming products are still being used for reviews
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        // Get all reviews
        $reviews = Review::all();
        $products = Product::all();
    
        return view('reviews.index', compact('reviews', 'products'));
    }
    
    public function create(Product $product)
    {
        // Get all reviews and products for the creation form
        $reviews = Review::all();
        $products = Product::all();
    
        return view('reviews.create', compact('products'));
    }
    
    public function store(ReviewRequest $request)
    {
        $review = new Review();
    
        $this->save($review, $request);
    
        return redirect('/reviews');
    }
    
    public function show($review)
    {
        $review = Review::find($review);
        $products = Product::all();
    
        return view('reviews.show', compact('review', 'products'));
    }
    
    public function edit(Review $review)
    {
        $products = Product::all();
        return view('reviews.edit', compact('review', 'products'));
    }
    
    public function update(ReviewRequest $request, Review $review)
    {
        // Update the review using the private save method
        $this->save($review, $request);
    
        return redirect('/reviews');
    }
    
    public function destroy(Review $review)
    {
        // Delete the review
        $review->delete();
    
        return redirect('/reviews');
    }

    private function save(Review $review, Request $request)
    {
        // Set the properties for the review and save it
        $review->title = $request->title;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();
        
        // Attach any related products (if applicable)
        $review->product_id = $request->product_id;
        $review->user_id = $request->user_id;
    }
}
