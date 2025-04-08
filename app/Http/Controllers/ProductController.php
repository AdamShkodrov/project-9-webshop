<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }
  
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
  
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name"     => $product->name,
                "price"    => $product->price,
                "quantity" => 1
            ];
        }
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product is toegevoegd aan de winkelwagen!');
    }

    public function create()
    {
        $products = Product::all();
        $categories = Category::all();

        return view('products.create', compact('products', 'categories'));
    }

    public function store(ProductRequest $request)
    {
        $product = new Product();

        $this->save($product, $request);

        return redirect('/products');
    }


    public function edit(Product $product)
    {   
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->save($product, $request);

        return redirect('/products');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/products');
    }

    private function save(Product $product, Request $request)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();
        $product->categories()->attach($request->category_id);

        return view('welcome', ['products' => Product::all()]);//mischien weghalen

    }
}
