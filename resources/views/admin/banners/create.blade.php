@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Banner</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="#">Banner</a>
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
                    <h3 class="card-title">Tambah Banner</h3>
                </div>

                <form action="/admin/banners" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="banner">
                                Banner <span class="text-danger font-weight-bold">*</span>
                            </label>
                            <input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror"
                                id="banner" value="{{ old('banner') }}">
                            @error('banner')
                                <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right ml-2">Simpan</button>
                        <a href="/admin/banners" class="btn btn-default float-right">Kembali</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
