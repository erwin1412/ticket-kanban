<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::get();

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'banner' => 'required|image|mimes:jpeg,jpg,png|max:2000'
        ], [
            'banner.required' => 'Gambar harus diisi!',
            'banner.image'    => 'File harus gambar!',
            'banner.mimes'    => 'Gambar hanya boleh bertipe jpeg,jpg,png!',
            'banner.max'      => 'Gambar maks 2 MB!'
        ]);

        $banner = $request->file('banner');
        $banner->storeAs('public/banners', $banner->hashName());

        Banner::create([
            'banner' => $banner->hashName()
        ]);

        return redirect('admin/banners')->with('success', 'Data berhasil disimpan');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'banner' => 'image|mimes:jpeg,jpg,png|max:2000'
        ], [
            'banner.image'  => 'File harus gambar!',
            'banner.mimes'  => 'Gambar hanya boleh bertipe jpeg,jpg,png!',
            'banner.max'    => 'Gambar maks 2 MB!'
        ]);


        if ($request->file('banner') == '') {
        } else {
            Storage::disk('local')->delete('public/banners/' . basename($banner->banner));

            $image = $request->file('banner');
            $image->storeAs('public/banners', $image->hashName());

            $banner = Banner::findOrFail($banner->id);
            $banner->update([
                'banner'  => $image->hashName()
            ]);
        }

        return redirect('admin/banners')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Banner $banner)
    {
        Storage::disk('local')->delete('public/banners/' . basename($banner->banner));

        $banner->delete();

        return redirect('admin/banners')->with('success', 'Data berhasil dihapus');
    }
}
