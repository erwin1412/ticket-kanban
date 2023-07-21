<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners    = Banner::all();
        $categories = Category::all();
        // $products = Product::all();
        $products   = Product::where('name', 'LIKE', '%' . request()->q . '%')
            ->get();


        return view('welcome', compact('banners', 'categories', 'products'));
    }

    public function category($name)
    {
        $category = Category::where('name', $name)
            ->first();
        $products = Product::with('category')
            ->where('category_id', $category->id)
            ->get();

        return view('category', compact('category', 'products'));
    }

    public function detail($slug)
    {
        $product = Product::where('slug', $slug)
            ->first();

        return view('detail', compact('product'));
    }
}
