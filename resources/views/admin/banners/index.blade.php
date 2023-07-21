@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Banner</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>

                            <li class="breadcrumb-item active">Banner</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Banner</h3>

                    <div class="card-tools">
                        <a href="/admin/banners/create" class="btn btn-primary btn-sm">Tambah</a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Banner</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($banners as $banner)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <a href="{{ $banner->banner }}" target="_blank">
                                            <img src="{{ $banner->banner }}" width="80">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/banners/{{ $banner->id }}/edit"
                                            class="btn btn-success btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#modal-hapus" data-id="{{ $banner->id }}"
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

            $('#form-hapus').attr('action', '/admin/banners/' + id);
        });
    </script>
@endsection
