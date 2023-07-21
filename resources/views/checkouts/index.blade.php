@extends('landings.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>
                            Checkout
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <form action="/checkout/pay" method="post">
                    @csrf

                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                    <input type="hidden" name="shipping_cost" id="shipping-cost-input">
                    <input type="hidden" name="total_amount" id="total-amount-input">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="alert alert-info alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-info"></i> Informasi</h5>
                                        Silahkan lengkapi data dibawah ini.
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="name">
                                                    Nama <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ auth()->user()->name }}" required>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="phone_number">
                                                    No HP <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <input type="text" name="phone_number" id="phone_number"
                                                    class="form-control" value="{{ auth()->user()->phone_number }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="province_destination">
                                                    Provinsi <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <select class="form-control" name="province_destination"
                                                    id="province_destination" required>
                                                    <option value=""></option>
                                                    @foreach ($provinces as $province => $value)
                                                        <option value="{{ $province }}_{{ $value }}">
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="city_destination">
                                                    Kota <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <select class="form-control" name="city_destination" id="city_destination"
                                                    required>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="weight">
                                                    Berat (gram) <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <input type="text" name="weight" id="weight" class="form-control"
                                                    value="{{ number_format($totalWeight, 0, ',', '.') }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="courier">
                                                    Kurir <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <select class="form-control" name="courier" id="courier" required>
                                                    <option value=""></option>
                                                    @foreach ($couriers as $courier => $value)
                                                        <option value="{{ $courier }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="service">
                                                    Service <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <select class="form-control" name="service" id="service" required>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="address">
                                                    Alamat Lengkap <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <textarea name="address" id="address" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="card-text">
                                        <span class="font-weight-bold d-block mb-2" style="margin-top: -7px">Rincian
                                            Belanja</span>
                                        <span class="d-block">
                                            Total Harga <strong class="float-right">
                                                Rp{{ number_format($totalPrice, 0, ',', '.') }}</strong>
                                        </span>
                                        <span class="d-block">
                                            Biaya Ongkir <strong class="float-right" id="shipping-cost">Rp</strong>
                                        </span>
                                        <span>
                                            Total Bayar <strong class="float-right" id="total-amount">Rp</strong>
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block" id="btn-pay" disabled>
                                Buat Pesanan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).on('change', '#province_destination', function() {
            const provinceId = $(this).val();

            $('#city_destination').empty();
            $('#courier').val('');
            $('#service').empty();
            $('#shipping-cost').text('Rp');
            $('#total-amount').text('Rp');
            $('#shipping-cost-input').val('');
            $('#total-amount-input').val('');

            if (provinceId) {

                $.ajax({
                    url: '/provinces/' + provinceId.split('_')[0] + '/cities',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#city_destination').empty();
                        $.each(data, function(key, value) {
                            $('#city_destination').append('<option value="' + key + '_' +
                                value +
                                '">' +
                                value +
                                '</option>');
                        });
                    }
                });

            } else {

                $('#city_destination').empty();

            }
        });

        $(document).on('change', '#city_destination', function() {

            $('#courier').val('');
            $('#service').empty();
            $('#shipping-cost').text('Rp');
            $('#total-amount').text('Rp');
            $('#shipping-cost-input').val('');
            $('#total-amount-input').val('');

        });

        $(document).on('change', '#courier', function() {
            const destination = $('#city_destination').val();
            const weight = $('#weight').val();
            const courier = $(this).val();
            const token = $("meta[name='csrf-token']").attr("content");

            $('#service').empty();
            $('#shipping-cost').text('Rp');
            $('#total-amount').text('Rp');
            $('#shipping-cost-input').val('');
            $('#total-amount-input').val('');

            if (courier) {

                $.ajax({
                    url: '/checkout/checkcost',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "destination": destination.split('_')[0],
                        "weight": weight,
                        "courier": courier,
                        "_token": token
                    },
                    success: function(data) {
                        // console.log(data);

                        const shippingCost = data[0].cost[0].value;
                        const totalPrice = '{{ $totalPrice }}';
                        const totalAmount = shippingCost + parseFloat(totalPrice);

                        $('#shipping-cost').text(`Rp${shippingCost.toLocaleString('id-ID')}`);
                        $('#total-amount').text(`Rp${totalAmount.toLocaleString('id-ID')}`);
                        $('#shipping-cost-input').val(shippingCost);
                        $('#total-amount-input').val(totalAmount);
                        $('#service').empty();

                        $.each(data, function(key, val) {
                            // OKE (Ongkos Kirim Ekonomis) - Biaya 12000 - Estimasi 2-3 Hari
                            $('#service').append(`
                            <option value="${val.service} (${val.description})_${val.cost[0].value}_${val.cost[0].etd}">
                                ${val.service} (${val.description}) - Biaya (Rp${val.cost[0].value.toLocaleString('id-ID')}) - Estimasi (${val.cost[0].etd} hari)
                            </option>
                        `);
                        });
                    }
                });

            } else {

                $('#service').empty();

            }
        });

        $(document).on('change', '#service', function() {
            const service = $(this).val();
            const totalPrice = '{{ $totalPrice }}';

            // Contoh data: OKE (Ongkos Kirim Ekonomis)_12000_2-3
            const shippingCost = parseFloat(service.split('_')[1]);
            const totalAmount = shippingCost + parseFloat(totalPrice);

            $('#shipping-cost').text(`Rp${shippingCost.toLocaleString('id-ID')}`);
            $('#total-amount').text(`Rp${totalAmount.toLocaleString('id-ID')}`);
            $('#shipping-cost-input').val(shippingCost);
            $('#total-amount-input').val(totalAmount);
        });

        $('#name, #phone_number, #province_destination, #city_destination, #weight, #courier, #service, #address').keyup(
            function() {

                if ($('#name').val() != '' && $('#phone_number').val() != '' && $('#province_destination').val() !=
                    '' && $('#city_destination').val() != '' && $('#weight').val() != '' && $('#courier').val() != '' &&
                    $('#service').val() != '' && $('#address').val() != '') {

                    $('#btn-pay').removeAttr('disabled');

                } else {

                    $('#btn-pay').attr('disabled', true);

                }

            });
    </script>
@endsection
