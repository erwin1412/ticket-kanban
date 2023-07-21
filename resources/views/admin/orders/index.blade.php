@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Order</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>

                            <li class="breadcrumb-item active">Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Order</h3>
                    <div class="card-tools">
                    </div>
                </div>

                <div class="card-body">
                    <form action="/admin/orders" method="get">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="start_date">
                                        Mulai Dari
                                    </label>
                                    <input type="date" name="start_date" class="form-control form-control-sm"
                                        id="start_date" value="{{ $startDate }}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="end_date">
                                        Sampai Dengan
                                    </label>
                                    <input type="date" name="end_date" class="form-control form-control-sm"
                                        id="end_date" value="{{ $endDate }}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm mr-2">Tampilkan</button>
                        <a href="/admin/orders/print?start_date={{ $startDate }}&end_date={{ $endDate }}"
                            class="btn btn-primary btn-sm" target="_blank">Cetak</a>
                    </form>
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Order</th>
                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Kurir</th>
                                <th>Service</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <a href="/admin/orders/detail/{{ $order->order_number }}">
                                            {{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->phone_number }}</td>
                                    <td>{{ $order->courier }}</td>
                                    <td>{{ $order->service }}</td>
                                    <td>{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($order->status == 'Unpaid')
                                            <span class="badge badge-secondary">Belum Bayar</span>
                                        @else
                                            <span class="badge badge-success">Sudah Bayar</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
