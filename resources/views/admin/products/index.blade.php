@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Produk</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Produk</h3>
                    <div class="card-tools">
                        <a href="/admin/products/create" class="btn btn-primary btn-sm">Tambah</a>
                        <a href="/admin/products/print" class="btn btn-primary btn-sm" target="_blank">Cetak</a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Berat</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->weight }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        <a href="{{ $product->image }}" target="_blank">
                                            <img src="{{ $product->image }}" width="50">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/products/{{ $product->id }}/edit"
                                            class="btn btn-success btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#modal-hapus" data-id="{{ $product->id }}"
                                            id="btn-hapus">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Anda yakin akan menghapus data?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="post" id="form-hapus">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-primary float-right ml-2">Iya</button>
                        <button type="button" class="btn btn-default float-right" data-dismiss="modal">Tidak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                toastr.success('{{ session('success') }}');
            });
        </script>
    @endif

    <script>
        $(document).on('click', '#btn-hapus', function() {
            const id = $(this).data('id');

            $('#form-hapus').attr('action', '/admin/products/' + id);
        });
    </script>
@endsection
