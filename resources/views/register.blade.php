<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Online Ticket Kanban</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="#">
                <b>Toko Online</b>Ticket Kanban
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mt-0 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register</p>

                <form action="/register" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Nama Lengkap" value="{{ old('name') }}" autofocus>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                            placeholder="No HP" value="{{ old('phone_number') }}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                            value="{{ old('email') }}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Password">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" placeholder="Konfirmasi password">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="btn-register"
                                disabled>Register</button>
                        </div>
                    </div>
                </form>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <a href="/login" class="text-center">Sudah punya akun</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#name, #phone_number, #email, #password, #password_confirmation').keyup(function() {

                if ($('#name').val() != '' && $('#phone_number').val() != '' && $('#email').val() !=
                    '' && $('#password').val() != '' && $('#password_confirmation').val() != '') {

                    $('#btn-register').removeAttr('disabled');

                } else {

                    $('#btn-register').attr('disabled', true);

                }

            });
        });
    </script>
</body>

</html>
