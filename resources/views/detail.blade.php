@extends('landings.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>
                            Detail Produk
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Selamat!</h5>
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $product->image }}" class="img-thumbnail" alt="{{ $product->name }}"
                            title="{{ $product->name }}">
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h3>{{ $product->name }}</h3>
                                <p class="text-secondary">{{ $product->description }}</p>
                                <h4 class="font-weight-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</h4>
                                <p class="mb-0">Berat: <span class="font-weight-bold">{{ $product->weight }}</span>
                                    Gram
                                </p>
                                <p>Stok: <span class="font-weight-bold">{{ $product->stock }}</span></p>

                                <div class="mt-4">
                                    @if ($product->stock == 0)
                                        <button class="btn btn-secondary" disabled>
                                            <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                            Tambah Keranjang
                                            </butt>
                                        @else
                                            <a href="/cart/add/{{ $product->slug }}" class="btn btn-secondary">
                                                <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                                Tambah Keranjang
                                            </a>
                                    @endif

                                    {{-- <div class="btn btn-primary">
                                        <i class="fas fa-clipboard-check fa-lg mr-2"></i>
                                        Beli Sekarang
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
