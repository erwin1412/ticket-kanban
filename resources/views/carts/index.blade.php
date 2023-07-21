@extends('landings.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>
                            Keranjang Belanja
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row">
                    @php
                        $totalPrice = 0;
                    @endphp
                    <div class="col-md-8">
                        @foreach ($carts as $cart)
                            @php
                                $totalPrice += $cart->product->price * $cart->qty;
                            @endphp
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="{{ $cart->product->image }}" alt="{{ $cart->product->name }}"
                                            style="width: 100%">
                                    </div>

                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="/detail/{{ $cart->product->slug }}" style="color: #212529">
                                                    {{ $cart->product->name }}
                                                </a>
                                            </h5>
                                            <p class="card-text">
                                                <span
                                                    class="font-weight-bold d-block">Rp{{ number_format($cart->product->price, 0, ',', '.') }}</span>
                                                <a href="/cart/min/{{ $cart->product->slug }}" class="mr-3">
                                                    <i class="fas fa-minus"></i>
                                                </a>
                                                <span class="font-weight-bold mr-3">{{ $cart->qty }}</span>
                                                <a href="/cart/add/{{ $cart->product->slug }}" class="mr-3">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                                <a href="/cart/delete/{{ $cart->product->slug }}"
                                                    class="text-danger">Hapus</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <p class="card-text">
                                    <span class="font-weight-bold d-block mb-2" style="margin-top: -7px">Rincian
                                        Belanja</span>
                                    <span class="d-block">
                                        Total Barang <strong class="float-right">{{ $totalQty }}</strong>
                                    </span>
                                    <span>
                                        Total Harga <strong
                                            class="float-right">Rp{{ number_format($totalPrice, 0, ',', '.') }}</strong>
                                    </span>
                                </p>
                            </div>
                        </div>

                        <a href="/checkout" class="btn btn-primary btn-block">
                            Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
