@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Order: <strong>{{ $order->order_number }}</strong></h1>
                    </div>

                    <div class="col-sm-6">
                        <a href="/admin/orders/print/{{ $order->order_number }}" class="btn btn-primary float-right"
                            target="_blank">Cetak</a>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="callout callout-info">
                <p class="mb-0">Nama: <strong>{{ $order->name }}</strong></p>
                <p class="mb-0">No HP: <strong>{{ $order->phone_number }}</strong></p>
                <p class="mb-0">Alamat: <strong>{{ $order->address }}</strong></p>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">QTY</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $key => $detail)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $detail->product->name }}</td>
                                    <td align="right">{{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                    <td align="center">{{ $detail->qty }}</td>
                                    <td align="right">
                                        {{ number_format($detail->product->price * $detail->qty, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="callout callout-info">
                <p class="mb-0 text-right">Total Harga:
                    <strong>Rp{{ number_format($order->total_price, 0, ',', '.') }}</strong>
                </p>
                <p class="mb-0 text-right">Biaya Ongkir:
                    <strong>Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</strong>
                </p>
                <p class="mb-0 text-right">Total Bayar:
                    <strong>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                </p>
            </div>
        </section>
    </div>
@endsection
