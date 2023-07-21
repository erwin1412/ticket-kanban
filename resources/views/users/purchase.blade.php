@extends('landings.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>
                            Pesanan
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pesanan</h3>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nomor Pesanan</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Total Pembayaran</th>
                                    <th class="text-center">Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>

                                        <td>
                                            <a href="/user/purchase/detail/{{ $order->order_number }}">
                                                {{ $order->order_number }}
                                            </a>
                                        </td>

                                        <td>
                                            {{ date('d M Y', strtotime($order->created_at)) }}
                                        </td>

                                        <td>
                                            Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                                        </td>

                                        <td class="project-state">
                                            @if ($order->status == 'Unpaid')
                                                <span class="badge badge-secondary">Belum Bayar</span>
                                            @else
                                                <span class="badge badge-success">Sudah Bayar</span>
                                            @endif
                                        </td>

                                        <td class="project-actions text-right">
                                            @if ($order->status == 'Unpaid')
                                                <button class="btn btn-info btn-sm" id="pay-button"
                                                    data-snaptoken="{{ $order->snap_token }}">
                                                    Pilih Pembayaran
                                                </button>
                                            @else
                                                <button class="btn btn-info btn-sm" disabled>
                                                    Pilih Pembayaran
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            const snapToken = this.dataset.snaptoken;

            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    // alert("payment success!");
                    // console.log(result);
                    window.location.href = '/user/purchase'
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    // console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    // console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            });
        });
    </script>
@endsection
