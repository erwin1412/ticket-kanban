@extends('landings.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>
                            Home
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($banners as $key => $banner)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                                        {{ $key == 0 ? 'class=active' : '' }}></li>
                                @endforeach
                            </ol>


                            <div class="carousel-inner">
                                @foreach ($banners as $key => $banner)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ $banner->banner }}" class="d-block w-100">
                                    </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </button>

                            <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title m-0">Kategori</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    @foreach ($categories as $key => $category)
                                        <div class="col-md-1 mb-2">
                                            <a href="/category/{{ strtolower($category->name) }}">
                                                <img src="{{ $category->image }}" class="img-thumbnail"
                                                    alt="{{ $category->name }}" title="{{ $category->name }}">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <form action="/">
                            <div class="input-group mb-3">
                                <input type="search" class="form-control" name="q"
                                    placeholder="Cari barang yang kamu inginkan disini ya.." value="{{ request()->q }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="">
                            Produk Terbaru
                        </h3>
                    </div>
                </div>


                <div class="row">
                    @foreach ($products as $key => $product)
                        <div class="col-sm-3">
                            <a href="/detail/{{ $product->slug }}">
                                <div class="card">
                                    <img src="{{ $product->image }}" class="card-img-top">

                                    <div class="card-body">
                                        <h5 class="card-title" style="color: #212529">{{ $product->name }}</h5>
                                        <p class="card-text text-muted">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
