@extends('layouts.dashboard-user')

@section('title','Halaman Transaksi')

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
              <li class="breadcrumb-item active">Transaksi</li>
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
                <h3 class="card-title">Data Transaksi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 5%">No</th>
                    <th>Kode Transaksi</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th style="width: 10%">Order</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($transaction as $item)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->kode }}</td>
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
                            <a href="{{ route('rincian.order.user', $item->id) }}" class="btn btn-sm btn-primary" style ='float: left;'>Rincian</a>
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