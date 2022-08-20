<style>
    .btn-checkout {
        display: block !important;
        /* width: calc(50% - 0px); */
        padding: 12px;
        background-color: #D10024;
        color: #FFF;
        text-align: center;
        font-weight: 700;
        -webkit-transition: 0.2s all;
        transition: 0.2s all;
    }
</style>
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="https://wa.me/62895321838995" target="_blank"><i class="fa fa-whatsapp"></i>+62 895-3218-38995</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i>tokolistrik@gmail.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i>Jl. Kemenangan No. 100</a></li>
            </ul>
            <ul class="header-links pull-right">
                @guest
                    <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i>Masuk</a></li>
                    <li><a href="{{ route('register') }}"><i class="fa fa-user-o"></i>Daftar Akun</a></li>
                @endguest
                @auth
                    <li><a href="{{ route('transaksi.index') }}"><i class="fa fa-list"></i>Transaksi Saya </a></li>
                    <li><a href="{{ route('profil.index') }}"><i class="fa fa-user-o"></i>Profil Saya |
                            {{ Auth::user()->name }}</a></li>
                    <li><a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i
                                class="fa fa-key"></i>Logout </a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                        @csrf
                    </form>

                @endauth
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo" style="background: white">
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('assets/logo-listrik.png') }}" alt="" style="max-width: 100px">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    {{-- <div class="header-search">
                        <form>
                            <select class="input-select">
                                <option value="0">All Categories</option>
                                <option value="1">Category 01</option>
                                <option value="1">Category 02</option>
                            </select>
                            <input class="input" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form>
                    </div> --}}
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->

                        <!-- /Wishlist -->

                        <!-- Cart -->
                        @auth
                            @php
                                $dataCarts = \App\Cart::where('user_id', Auth::user()->id);

                                $carts = $dataCarts->get();
                                $cartss = $dataCarts->get();

                                $count = $dataCarts->count();

                                // $totalPrice = $dataCarts->;

                                $itemCount = $dataCarts->sum('qty');

                                $totalPrice = 0;

                            @endphp
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">{{ $count }}</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        @foreach ($carts as $item)
                                            @php
                                                $qty = $item->qty;
                                                $harga = $item->produk->harga;

                                                $totalPrice += $harga * $qty;
                                            @endphp
                                            <div class="product-widget">
                                                <div class="product-img">
                                                    <img src="{{ asset(json_decode($item->produk->gambar)[0]) }}"
                                                        alt="">
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-name"><a
                                                            href="#">{{ $item->produk->nama_produk }}</a></h3>
                                                    <h4 class="product-price"><span
                                                            class="qty">{{ $item->qty }}x</span>Rp.{{ number_format($item->produk->harga) }}
                                                    </h4>
                                                </div>
                                                <form action="{{ route('delete.cart', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="delete"><i class="fa fa-close"></i></button>
                                                </form>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="cart-summary">
                                        <small>{{ $itemCount }} Item(s) selected</small>
                                        <h5>SUBTOTAL: Rp. {{ number_format($totalPrice) }}</h5>

                                    </div>
                                    @if ($count > 0)
                                        <div class="cart-btns">
                                            {{-- <a href="#">View Cart</a> --}}
                                            <form action="#" method="POST">
                                                @csrf
                                                <input type="hidden" name="total_harga" value="{{ $totalPrice }}">

                                                <a href="{{ route('checkout.index') }}"
                                                    class="btn btn-block btn-danger">Checkout</a>
                                            </form>
                                        </div>
                                    @else
                                        <div class=""></div>
                                    @endif
                                </div>
                            </div>
                        @endauth
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
