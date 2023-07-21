@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Profile</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Profile
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ubah Profile</h3>
                        </div>

                        <form action="/admin/profile" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">
                                        Nama <span class="text-danger font-weight-bold">*</span>
                                    </label>

                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name') == '' ? $user->name : old('name') }}">
                                    @error('name')
                                        <div class="text-small text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">
                                        Email <span class="text-danger font-weight-bold">*</span>
                                    </label>

                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        value="{{ old('email') == '' ? $user->email : old('email') }}">
                                    @error('email')
                                        <div class="text-small text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">
                                        No HP
                                    </label>

                                    <input type="text" name="phone_number" class="form-control" id="phone_number"
                                        value="{{ old('phone_number') == '' ? $user->phone_number : old('phone_number') }}">
                                </div>

                                <div class="form-group">
                                    <label for="role">
                                        Role
                                    </label>

                                    @if ($user->role == '1')
                                        <input class="form-control" id="role" value="Admin" disabled>
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right ml-2">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ubah Password</h3>
                        </div>

                        <form action="/admin/profile/change-password" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="password">
                                        Password <span class="text-danger font-weight-bold">*</span>
                                    </label>

                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password">
                                    @error('password')
                                        <div class="text-small text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">
                                        Konfirmasi Password <span class="text-danger font-weight-bold">*</span>
                                    </label>

                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation">
                                    @error('password_confirmation')
                                        <div class="text-small text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right ml-2">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @if (session('message'))
        <script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                toastr.success('{{ session('message') }}');
            });
        </script>
    @endif
@endsection
