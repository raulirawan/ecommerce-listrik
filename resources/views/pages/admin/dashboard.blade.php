@extends('layouts.dashboard-admin')

@section('title','Dashboard Admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $dibayar ?? '' }}</h3>

                  <p>Transaksi Di Bayar</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $sukses ?? '' }}</h3>


                  <p>Transaksi Sukses</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $pending ?? '' }}</h3>

                  <p>Transaksi Pending</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $gagal ?? '' }}</h3>

                  <p>Transaksi Gagal</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
          </div>
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Form Retur Barang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                {{-- <a href="{{ route('export.transaksi') }}" class="btn btn-primary mb-2">Export Transaksi</a> --}}

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 5%">No</th>
                    <th>No Resi</th>
                    <th>Kode Transaksi</th>
                    <th>Nama Customer</th>
                    <th>Status</th>
                    <th style="width: 10%">Aksi</th>

                  </tr>
                  </thead>
                  <tbody>
                      {{-- @foreach ($transactions as $item)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->kode }}</td>
                          <td>{{ $item->user->name }}</td>
                          <td>Rp. {{ number_format($item->total_harga) }}</td>
                          <td>
                            @if ($item->status_transaksi == 'SUCCESS')
                              <div class="badge badge-success">SUCCESS</div>
                            @elseif ($item->status_transaksi == 'PENDING')
                              <div class="badge badge-warning">PENDING</div>
                            @elseif ($item->status_transaksi == 'DIBAYAR')
                              <div class="badge badge-info">DIBAYAR</div>
                            @else
                              <div class="badge badge-danger">FAILED</div>
                            @endif
                          </td>
                          <td style="text-align: center !important;">
                            <a href="{{ route('rincian.order', $item->id) }}" class="btn btn-sm btn-primary" style ='float: left;'>Rincian</a>
                          </td>

                      </tr>
                      @endforeach --}}
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
