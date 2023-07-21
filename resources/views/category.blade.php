@extends('landings.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>
                            Kategori {{ $category->name }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
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
