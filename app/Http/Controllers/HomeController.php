<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Haal alle producten op
        $products = Product::all();

        // Stuur de producten naar de welcome view
        return view('welcome', compact('products'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Haal alle producten op
        $products = Product::all();

        // Stuur de producten naar de welcome view
        return view('welcome', compact('products'));
    }
}
