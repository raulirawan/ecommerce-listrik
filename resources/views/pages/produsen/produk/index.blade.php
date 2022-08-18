@extends('layouts.dashboard-admin')

@section('title', 'Halaman Produk')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Produk</h1>
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
                        @if (session()->has('sukses'))
                            <div class="alert alert-success">
                                {{ session()->get('sukses') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Produk</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th>Nama Produk</th>
                                            <th style="width: 10%">Gambar</th>
                                            <th>Harga Produsen</th>
                                            <th style="width: 15%">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($produk as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_produk }}</td>
                                                <td>
                                                    <img src="{{ asset(json_decode($item->gambar)[0]) }}"
                                                        style="width: 100px">
                                                </td>
                                                <td>
                                                    @if ($item->harga_produsen)
                                                        Rp.{{ number_format($item->harga_produsen) }}
                                                    @else
                                                        Belum Tersedia
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                        id="edit" data-id="{{ $item->id }}"
                                                        data-harga_produsen="{{ $item->harga_produsen }}"
                                                        data-target="#modal-edit" style='float: left;'>Edit Harga</button>

                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
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

    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Harga Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="form-edit" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Harga Produsen</label>
                            <input type="text" name="harga_produsen" id="harga_produsen" class="form-control"
                                placeholder="Masukan Harga Produsen" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('down-script')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#edit', function() {
                var id = $(this).data('id');
                var harga_produsen = $(this).data('harga_produsen');
                $('#harga_produsen').val(harga_produsen);
                $('#form-edit').attr('action', '/produsen/produk/update/harga/' + id);
            });
        });
    </script>
@endpush
