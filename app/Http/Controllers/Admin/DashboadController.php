<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboadController extends Controller
{
    public function index()
    {
        $categories  = Category::count();
        $products    = Product::count();
        $banners     = Banner::count();
        $customers   = User::where('role', '!=', '1')
            ->count();
        $stockProduk = Product::where('stock', '<=', 50)
            ->pluck('stock', 'name');
        $labels      = $stockProduk->keys();
        $data        = $stockProduk->values();

        return view('admin.dashboard.index', compact('categories', 'products', 'banners', 'customers', 'labels', 'data'));
    }
}
