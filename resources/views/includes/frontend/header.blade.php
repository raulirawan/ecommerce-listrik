<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i>+62 81298148785</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i>serlyhartati0911@gmail.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i>Pasar Hipli</a></li>
            </ul>
            <ul class="header-links pull-right">
                @guest
                    <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i>Masuk</a></li>   
                    <li><a href="{{ route('register') }}"><i class="fa fa-user-o"></i>Daftar Akun</a></li>   
                @endguest
                @auth
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-user-o"></i> My Dashboard | {{ Auth::user()->name }}</a></li>
                    
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
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <img src="{{asset('/frontend')}}/img/logoo.png" alt="" style="max-width: 100px">
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
                        $dataCarts = \App\Cart::where('users_id', Auth::user()->id);

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
                                            $harga = $item->product->harga;

                                            $totalPrice += $harga * $qty;
                                        @endphp
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{ Storage::url($item->product->galleries->first()->photos) }}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">{{ $item->product->nama }}</a></h3>
                                                <h4 class="product-price"><span class="qty">{{ $item->qty }}x</span>Rp.{{ number_format($item->product->harga) }}</h4>
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
                                    <form action="{{ route('checkout') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="total_harga" value="{{ $totalPrice }}">
                                        <div class="form-group" style="margin-left: 17px; margin-right: 17px">
                                            <label for="exampleFormControlSelect1">Pilih Bank Transfer</label>
                                            <select class="form-control" name="bank" id="bank">
                                                <option value="BCA a/n : Serly Hartati 238030831">BCA a/n : Serly Hartati 238030831</option>
                                                <option value="BNI a/n : Serly Hartati 564354324">BNI a/n : Serly Hartati 238030831</option>
                                                <option value="BRI a/n : Serly Hartati 343466456">BRI a/n : Serly Hartati 238030831</option>
                                            </select>
                                          </div>
                                       
                                        <button type="submit">Checkout<i class="fa fa-arrow-circle-right"></i></button>
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