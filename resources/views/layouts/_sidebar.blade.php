<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/admin/dashboard" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="Toko Online Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Toko Online Ticket Kanban</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">

                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link {{ Request::is('admin/dashboard*') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">Master Data</li>

                <li class="nav-item">
                    <a href="/admin/categories"
                        class="nav-link {{ Request::is('admin/categories*') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-search"></i>
                        <p>Kategory</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/products" class="nav-link {{ Request::is('admin/products*') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Produk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/banners" class="nav-link {{ Request::is('admin/banners*') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>Banner</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/customers" class="nav-link {{ Request::is('admin/customers*') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Customer</p>
                    </a>
                </li>

                <li class="nav-header">Transaksi</li>

                <li class="nav-item">
                    <a href="/admin/orders" class="nav-link {{ Request::is('admin/orders*') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Order</p>
                    </a>
                </li>

                <li class="nav-header">Setting</li>

                <li class="nav-item">
                    <a href="/admin/profile" class="nav-link {{ Request::is('admin/profile*') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-id-card-alt"></i>
                        <p>Profile</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-logout">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>

<div class="modal fade" id="modal-logout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Apakah Anda yakin akan keluar?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/logout" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary float-right ml-2">Iya</button>
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Tidak</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
