<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ url('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LISTRIK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name ?? '' }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if (Auth::user()->roles == 'SUPPLIER')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.admin') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('produk.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Produk
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaksi.admin.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Transaksi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order.admin.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Form Pemesanan
                            </p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('dashboard.supplier') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('produsen.produk.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Produk
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
