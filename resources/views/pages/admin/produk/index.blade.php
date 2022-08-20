@extends('layouts.dashboard-admin')

@section('title','Halaman Produk')

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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Produk</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="{{ route('produk.create') }}" class="btn btn-primary mb-2">(+) Tambah Produk</a>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 5%">No</th>
                    <th>Nama Produk</th>
                    <th style="width: 10%">Gambar</th>
                    <th>Harga</th>
                    <th style="width: 10%">Stok</th>
                    <th style="width: 10%">Pre Order</th>
                    <th style="width: 15%">Aksi</th>

                  </tr>
                  </thead>
                  <tbody>

                    @foreach ($produk as $item)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>
                            <img src="{{ asset(json_decode($item->gambar)[0] ?? 'assets/images/no-image.jpg') }}" style="width: 100px">
                        </td>
                        <td>Rp.{{ number_format($item->harga) }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>
                            @if ($item->is_pre_order == 1)
                            <span class="badge badge-success">Ya</span>
                            @else
                            <span class="badge badge-danger">Tidak</span>
                            @endif
                        </td>
                        <td>
                          <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-primary" style ='float: left;'>Edit</a>
                          <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style ='float: left; padding-left: 5px;'>
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ?')">Hapus</button>

                          </form>
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
@endsection

@push('down-script')
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
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
@endpush
