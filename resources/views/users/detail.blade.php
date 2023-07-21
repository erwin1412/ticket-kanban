@extends('landings.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>
                            Detail Order: <strong>{{ $order->order_number }}</strong>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="/user/purchase/print/{{ $order->order_number }}" class="btn btn-primary float-right"
                            target="_blank">Cetak</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="callout callout-info">
                    <p class="mb-0">Nama: <strong>{{ $order->name }}</strong></p>
                    <p class="mb-0">No HP: <strong>{{ $order->phone_number }}</strong></p>
                    <p class="mb-0">Alamat: <strong>{{ $order->address }}</strong></p>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pesanan</h3>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-striped projects">
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
                                        <td align="right">Rp{{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                        <td align="center">{{ $detail->qty }}</td>
                                        <td align="right">
                                            Rp{{ number_format($detail->product->price * $detail->qty, 0, ',', '.') }}</td>
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
            </div>
        </div>
    </div>
@endsection
