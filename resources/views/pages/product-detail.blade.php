@extends('layouts.app')

@section('title','Toko Melati')
@section('content')

    <div class="row">
        <div class="col-12">
         
        </div>
    </div>
	<!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <div class="row">
                <div class="col-md 12">
                    @if(session()->has('sukses'))
                    <div class="alert alert-success">
                        {{ session()->get('sukses') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="#">{{ $product->category->nama }}</a></li>
                        <li class="active">{{ $product->nama }}</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        @foreach ($product->galleries as $gallery)
                        <div class="product-preview">
                            <img src="{{ Storage::url($gallery->photos) }}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        
                        @foreach ($product->galleries as $gallery)
                            <div class="product-preview">
                                <img src="{{ Storage::url($gallery->photos) }}" alt="">
                            </div>
                        @endforeach

                        
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{ $product->nama }}</h2>
                        {{-- <div>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <a class="review-link" href="#">10 Review(s) | Add your review</a>
                        </div> --}}
                        <div>
                            <h3 class="product-price">Rp.{{ number_format($product->harga) }}</h3>
                            <br/>
                            <h6>Stok : {{ $product->stok }}</h6>
                                {{-- <del class="product-old-price">$990.00</del></h3>
                            <span class="product-available">In Stock</span> --}}
                        </div>
                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> --}}
                        <div class="dekripsi">
                            {!! $product->deskripsi !!}
                        </div>
                        <form action="{{ route('add.to.cart', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="add-to-cart">
                                <div class="qty-label">
                                    Qty
                                    <div class="input-number">
                                        <input type="number" name="qty">
                                    </div>
                                </div>
                                @if ($product->ukuran_id != null)
                                <div class="qty-label">
                                    Ukuran
                                    <div class="input-number">
                                        <select name="ukuran" id="ukuran" class="form-control">
                                            @for ($i=1; $i<=10; $i++)
                                            <option value="{{ $product->ukuran->{"ukuran{$i}"} }}">{{ $product->ukuran->{"ukuran{$i}"} }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                @else
                                <div class="div"></div>
                                @endif
                            </div>
                            <button class="btn btn-danger"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        </form>

                        {{-- <ul class="product-btns">
                            <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                            <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
                        </ul>

                        <ul class="product-links">
                            <li>Category:</li>
                            <li><a href="#">Headphones</a></li>
                            <li><a href="#">Accessories</a></li>
                        </ul>

                        <ul class="product-links">
                            <li>Share:</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul> --}}

                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                {{-- <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                            
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->

                         
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div> --}}
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>

@endsection
