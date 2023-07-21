@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Produk</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Produk</a>
                            </li>
                            <li class="breadcrumb-item active">Tambah</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Produk</h3>
                </div>

                <form action="/admin/products" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category_id">
                                Kategori <span class="text-danger font-weight-bold">*</span>
                            </label>
                            <select name="category_id" id="category_id"
                                class="form-control @error('category_id') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($categories as $categories)
                                    <option value="{{ $categories->id }}"
                                        {{ old('category_id') == $categories->id ? 'selected' : '' }}>
                                        {{ $categories->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">
                                Nama <span class="text-danger font-weight-bold">*</span>
                            </label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">
                                Harga <span class="text-danger font-weight-bold">*</span>
                            </label>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                id="price" value="{{ old('price') }}">
                            @error('price')
                                <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stock">
                                Stok <span class="text-danger font-weight-bold">*</span>
                            </label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                                id="stock" value="{{ old('stock') }}">
                            @error('stock')
                                <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="weight">
                                Berat (gram) <span class="text-danger font-weight-bold">*</span>
                            </label>
                            <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror"
                                id="weight" value="{{ old('weight') }}">
                            @error('weight')
                                <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">
                                Deskripsi
                            </label>
                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">
                                Gambar <span class="text-danger font-weight-bold">*</span>
                            </label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                id="image" value="{{ old('image') }}">
                            @error('image')
                                <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right ml-2">Simpan</button>
                        <a href="/admin/products" class="btn btn-default float-right">Kembali</a>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script>
        const price = document.getElementById('price');
        price.addEventListener('keyup', function(e) {
            price.value = formatRupiah(this.value);
        });


        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endsection
