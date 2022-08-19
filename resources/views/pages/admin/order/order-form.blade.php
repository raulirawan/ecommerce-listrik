@extends('layouts.dashboard-admin')

@section('title', 'Halaman Tambah Product')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Form Tambah Data Produk</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="POST" action="{{ route('order.form.post') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Produk</label>
                                        <select name="produk_id" id="produk_id" class="form-control" required>
                                            <option value="">Pilih Produk</option>
                                            @foreach (App\Produk::where('is_pre_order', 1)->whereNotNull('harga_produsen')->get() as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_produk }}
                                                    (Rp{{ number_format($item->harga_produsen) ?? 'Belum Tersedia' }})
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        <input type="number" id="quantity" placeholder="Masukan Quantity" value="1"
                                            name="qty" class="form-control" required>

                                    </div>


                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Tambah Keranjang</button>
                                </div>
                            </form>

                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Keranjang</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th>Nama Produk</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th style="width: 10%">Aksi</th>
                                            </tr>

                                        </thead>
                                        <tbody id="keranjang">
                                            @php
                                                $carts = App\Cart::where('user_id', Auth::user()->id)->get();
                                            @endphp
                                            @foreach ($carts as $cart)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $cart->produk->nama_produk }}</td>
                                                    <td>{{ $cart->qty }}</td>
                                                    <td>Rp{{ number_format($cart->harga) }}</td>
                                                    <td>
                                                        <a href="{{ route('order.form.delete', $cart->id) }}"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ?')">Hapus</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="3">Total Harga</td>
                                                <td id="total_harga">Rp{{ number_format($carts->sum('harga')) }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>


                                <a href="{{ route('checkout.barang') }}" class="btn btn-primary btn-sm"
                                    onclick="return confirm('Yakin ?')">Checkout Barang</a>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('down-script')
    <script>
        $("#btn-tambah-keranjang").click(function(e) {
            e.preventDefault();
            var produk_id = $('select[name=produk_id] option').filter(':selected').val();
            var quantity = $("#quantity").val();
            if (produk_id == '') {
                alert('Pilih Produk!');
                return false;
            }

            if (quantity == '') {
                alert('Masukan Quantity!');
                return false;
            }
            $.ajax({
                type: "POST",
                url: "{{ route('order.form.post') }}",
                data: {
                    produk_id: produk_id,
                    quantity: quantity,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {

                }
            });
        });
    </script>
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("editor");
    </script>
@endpush
