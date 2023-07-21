<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|unique:categories',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2000'
        ], [
            'name.required'  => 'Nama harus diisi!',
            'name.unique'    => 'Nama sudah terdaftar!',
            'image.required' => 'Gambar harus diisi!',
            'image.image'    => 'File harus gambar!',
            'image.mimes'    => 'Gambar hanya boleh bertipe jpeg,jpg,png!',
            'image.max'      => 'Gambar maks 2 MB!'
        ]);

        $image = $request->file('image');
        $image->storeAs('public/categories', $image->hashName());

        Category::create([
            'image' => $image->hashName(),
            'name'  => $request->name,
            'slug'  => Str::of($request->name)->slug('-')
        ]);

        return redirect('admin/categories')->with('success', 'Data berhasil disimpan');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        if ($request->name == $category->name) {
            $this->validate($request, [
                'name'  => 'required',
                'image' => 'image|mimes:jpeg,jpg,png|max:2000'
            ], [
                'name.required'  => 'Nama harus diisi!',
                'image.image'    => 'File harus gambar!',
                'image.mimes'    => 'Gambar hanya boleh bertipe jpeg,jpg,png!',
                'image.max'      => 'Gambar maks 2 MB!'
            ]);
        } else {
            $this->validate($request, [
                'name'  => 'required|unique:categories',
                'image' => 'image|mimes:jpeg,jpg,png|max:2000'
            ], [
                'name.required'  => 'Nama harus diisi!',
                'name.unique'    => 'Nama sudah terdaftar!',
                'image.image'    => 'File harus gambar!',
                'image.mimes'    => 'Gambar hanya boleh bertipe jpeg,jpg,png!',
                'image.max'      => 'Gambar maks 2 MB!'
            ]);
        }


        if ($request->file('image') == '') {
            $category = Category::findOrFail($category->id);
            $category->update([
                'name'   => $request->name,
                'slug'  => Str::of($request->name)->slug('-')
            ]);
        } else {
            Storage::disk('local')->delete('public/categories/' . basename($category->image));

            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            $category = Category::findOrFail($category->id);
            $category->update([
                'name'   => $request->name,
                'slug'  => Str::of($request->name)->slug('-'),
                'image'  => $image->hashName()
            ]);
        }

        return redirect('admin/categories')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Category $category)
    {
        Storage::disk('local')->delete('public/categories/' . basename($category->image));

        $category->delete();

        return redirect('admin/categories')->with('success', 'Data berhasil dihapus');
    }

    public function print()
    {
        $categories = Category::get();

        return view('admin.categories.print', compact('categories'));
    }
}
