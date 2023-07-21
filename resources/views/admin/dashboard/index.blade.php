@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>

                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $categories }}</h3>
                                <p>Kategori</p>
                            </div>

                            <div class="icon">
                                <i class="fas fa-search"></i>
                            </div>

                            <a href="/admin/categories" class="small-box-footer">
                                Info Selanjutnya <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $products }}</h3>

                                <p>Produk</p>
                            </div>

                            <div class="icon">
                                <i class="fas fa-shopping-bag"></i>
                            </div>

                            <a href="/admin/products" class="small-box-footer">
                                Info Selanjutnya <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $banners }}</h3>
                                <p>Banner</p>
                            </div>

                            <div class="icon">
                                <i class="fas fa-image"></i>
                            </div>

                            <a href="/admin/banners" class="small-box-footer">
                                Info Selanjutnya <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $customers }}</h3>
                                <p>Customer</p>
                            </div>

                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>

                            <a href="/admin/customers" class="small-box-footer">
                                Info Selanjutnya <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Stok produk yang kurang dari 50</h3>
                            </div>

                            <div class="card-body">
                                <canvas id="pieChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('script_footer')
    <script>
        // Fungsi untuk menghasilkan warna acak
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        const backgroundColor = [];

        function getColor(value) {
            for (let i = 0; i < value; i++) {
                backgroundColor.push(getRandomColor());
            }
        }

        getColor({!! $data !!}.length);

        var donutData = {
            labels: {!! $labels !!},
            datasets: [{
                data: {!! $data !!},
                backgroundColor: backgroundColor
            }]
        }
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = donutData;
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })
    </script>
@endpush
