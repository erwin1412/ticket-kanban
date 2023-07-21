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

                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Banner</h3>
                </div>

                <form action="/admin/banners/{{ $banner->id }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="banner">Banner</label>
                            <input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror"
                                id="banner">
                            @error('banner')
                                <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right ml-2">Update</button>
                        <a href="/admin/banners" class="btn btn-default float-right">Kembali</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
