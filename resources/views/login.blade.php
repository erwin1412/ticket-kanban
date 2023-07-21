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

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">
                <b>Toko Online</b>Ticket Kanban
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Selamat!</h5>
                {{ session('success') }}
            </div>
        @endif

        @error('email')
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-ban"></i> {{ $message }}
            </div>
        @enderror

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Login</p>

                <form action="/login" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                            autofocus>

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

                    <div class="row justify-content-end">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="btn-login"
                                disabled>Login</button>
                        </div>
                    </div>
                </form>

                <div class="row justify-content-center mt-3">
                    <div class="col-md-4">
                        <a href="/register" class="text-center">Buat Akun</a>
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
            $('#email, #password').keyup(function() {

                if ($('#email').val() != '' && $('#password').val() != '') {

                    $('#btn-login').removeAttr('disabled');

                } else {

                    $('#btn-login').attr('disabled', true);

                }

            });
        });
    </script>
</body>

</html>
