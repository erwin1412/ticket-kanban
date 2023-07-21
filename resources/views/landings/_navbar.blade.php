<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="Toko Online Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Toko Online Ticket Kanban</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            @auth
                @if (auth()->user()->role == 2)
                    <li class="nav-item">
                        <a class="nav-link" href="/cart">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge badge-danger navbar-badge">{{ auth()->user()->carts->count() }}</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-user"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                Akun
                            </a>

                            <a href="/user/purchase" class="dropdown-item">
                                Pesanan
                            </a>

                            <a href="/logout" class="dropdown-item">
                                Logout
                            </a>
                        </div>
                    </li>
                @endif
            @endauth

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="/login">
                        Login
                    </a>
                </li>
            @endguest
        </ul>
    </div>
</nav>
