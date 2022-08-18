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

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Form Tambah Data Produk</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Produk</label>
                                        <input type="text" class="form-control" value="{{ old('nama_produk') }}"
                                            name="nama_produk" placeholder="Nama Produk">

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Stok</label>
                                        <input type="number" class="form-control" value="{{ old('stok') }}"
                                            name="stok" placeholder="Stok">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Harga</label>
                                        <input type="number" class="form-control" value="{{ old('harga') }}"
                                            name="harga" placeholder="Harga">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Deskripsi Produk</label>
                                        <textarea name="deskripsi" class="form-control" value="{{ old('deskripsi') }}" id="editor"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Gambar Produk</label>
                                        <div class="text-muted">Kamu Bisa Memilih Lebih dari Satu Gambar</div>
                                        <input type="file" class="form-control" name="gambar[]" multiple="true">
                                        @if ($errors->has('gambar.*'))
                                            <span class="text-danger">{{ $errors->first('gambar.*') }}</span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Is Pre Order</label>
                                        <select name="is_pre_order" id="is_pre_order" class="form-control" required>
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                        </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>

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
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("editor");
    </script>
@endpush
