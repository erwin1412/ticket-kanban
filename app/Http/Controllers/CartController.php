<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts      = Cart::with('product')
            ->where('user_id', auth()->user()->id)
            ->get();
        $totalQty   = Cart::sum('qty');

        return view('carts.index', compact('carts', 'totalQty'));
    }

    public function save($slug)
    {
        $product        = Product::where('slug', $slug)->first();
        $checkProduct   = Cart::where('product_id', $product->id)->first();

        if ($checkProduct) {
            $cart       = Cart::find($checkProduct->id);
            $cart->qty  = $cart->qty + 1;
            $cart->save();
        } else {
            $cart               = new Cart;
            $cart->user_id      = auth()->user()->id;
            $cart->product_id   = $product->id;
            $cart->qty          = 1;
            $cart->save();
        }

        // return redirect("detail/$slug")->with('success', 'Produk telah ditambahkan ke keranjang belanja');
        return redirect()->back();
    }

    public function min($slug)
    {
        $product        = Product::where('slug', $slug)->first();
        $checkProduct   = Cart::where('product_id', $product->id)->first();

        if ($checkProduct) {
            $cart       = Cart::find($checkProduct->id);
            if ($cart->qty == 1) {
                $cart->delete();
            } else {
                $cart->qty  = $cart->qty - 1;
                $cart->save();
            }
        } else {
            $cart               = new Cart;
            $cart->user_id      = auth()->user()->id;
            $cart->product_id   = $product->id;
            $cart->qty          = 1;
            $cart->save();
        }

        // return redirect("detail/$slug")->with('success', 'Produk telah ditambahkan ke keranjang belanja');
        return redirect()->back();
    }

    public function delete($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $cart    = Cart::where('product_id', $product->id)->first();
        $cart->delete();

        return redirect("/cart");
    }
}
