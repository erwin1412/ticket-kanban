<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id'   => 'required',
            'name'          => 'required',
            'price'         => 'required',
            'stock'         => 'required',
            'weight'        => 'required',
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2000'
        ], [
            'category_id.required'  => 'Kategori harus diisi!',
            'name.required'         => 'Nama harus diisi!',
            'price.required'        => 'Harga harus diisi!',
            'stock.required'        => 'Stok harus diisi!',
            'weight.required'       => 'Berat harus diisi!',
            'image.required'        => 'Gambar harus diisi!',
            'image.image'           => 'File harus gambar!',
            'image.mimes'           => 'Gambar hanya boleh bertipe jpeg,jpg,png!',
            'image.max'             => 'Gambar maks 2 MB!'
        ]);

        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        Product::create([
            'category_id'   => $request->category_id,
            'name'          => $request->name,
            'slug'          => Str::of($request->name)->slug('-'),
            'price'         => str_replace('.', '', $request->price),
            'stock'         => $request->stock,
            'weight'        => $request->weight,
            'description'   => $request->description,
            'image'         => $image->hashName()
        ]);

        return redirect('admin/products')->with('success', 'Data berhasil disimpan');
    }

    public function edit(Product $product)
    {
        $categories = Category::get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'category_id'   => 'required',
            'name'          => 'required',
            'price'         => 'required',
            'stock'         => 'required',
            'weight'        => 'required',
            'image'         => 'image|mimes:jpeg,jpg,png|max:2000'
        ], [
            'category_id.required'  => 'Kategori harus diisi!',
            'name.required'         => 'Nama harus diisi!',
            'price.required'        => 'Harga harus diisi!',
            'stock.required'        => 'Stok harus diisi!',
            'weight.required'       => 'Berat harus diisi!',
            'image.image'           => 'File harus gambar!',
            'image.mimes'           => 'Gambar hanya boleh bertipe jpeg,jpg,png!',
            'image.max'             => 'Gambar maks 2 MB!'
        ]);

        if ($request->file('image') == '') {
            $product = Product::findOrFail($product->id);
            $product->update([
                'category_id'   =>  $request->category_id,
                'name'          =>  $request->name,
                'slug'          => Str::of($request->name)->slug('-'),
                'price'         =>  str_replace('.', '', $request->price),
                'stock'         =>  $request->stock,
                'weight'        =>  $request->weight,
                'description'   => $request->description
            ]);
        } else {
            Storage::disk('local')->delete('public/products/' . basename($product->image));

            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            $product = Product::findOrFail($product->id);
            $product->update([
                'category_id'   =>  $request->category_id,
                'name'          =>  $request->name,
                'slug'          => Str::of($request->name)->slug('-'),
                'price'         =>  str_replace('.', '', $request->price),
                'stock'         =>  $request->stock,
                'weight'        =>  $request->weight,
                'description'   => $request->description,
                'image'         => $image->hashName()
            ]);
        }

        return redirect('admin/products')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Product $product)
    {
        Storage::disk('local')->delete('public/products/' . basename($product->image));

        $product->delete();

        return redirect('admin/products')->with('success', 'Data berhasil dihapus');
    }

    public function print()
    {
        $products = Product::with('category')
            ->get();

        return view('admin.products.print', compact('products'));
    }
}
