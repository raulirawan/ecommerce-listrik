@extends('layouts.dashboard-admin')

@section('title', 'Dashboard Admin')

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
                                <h3>Rp{{ number_format(App\Transaksi::where('jenis_transaksi', 'SUPPLIER')->whereIn('status', ['SUDAH BAYAR', 'SELESAI', 'SEDANG DIKIRIM'])->sum('total_harga')) }}
                                </h3>

                                <p>Penghasilan</p>
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
                                <h3>{{ App\Transaksi::where('jenis_transaksi', 'SUPPLIER')->where('status', 'SELESAI')->count() }}
                                </h3>


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
                                <h3>{{ App\Transaksi::where('jenis_transaksi', 'SUPPLIER')->where('status', 'PENDING')->count() }}
                                </h3>

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
                                <h3>{{ App\Transaksi::where('jenis_transaksi', 'SUPPLIER')->where('status', 'BATAL')->count() }}
                                </h3>

                                <p>Transaksi Batal</p>
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
                                <h3 class="card-title">Data Form Orderan</h3>
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
                                            <th>Bukti Transfer</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (App\Transaksi::where('jenis_transaksi', 'SUPPLIER')->orderBy('created_at', 'DESC')->get() as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->no_resi ?? 'Belum Tersedia' }}</td>
                                                <td>{{ $item->kode_transaksi }}</td>
                                                <td>
                                                    @if ($item->bukti_transfer != null)
                                                        <img src="{{ asset($item->bukti_transfer) }}" style="width: 100px">
                                                    @else
                                                        Belum Tersedia
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status == 'PENDING')
                                                        <span class="text-white badge badge-warning">PENDING</span>
                                                    @elseif ($item->status == 'SUDAH BAYAR')
                                                        <span class="text-white badge badge-success">SUDAH BAYAR</span>
                                                    @elseif ($item->status == 'SEDANG DIKIRIM')
                                                        <span class="text-white badge badge-warning">SEDANG DIKIRIM</span>
                                                    @elseif ($item->status == 'SELESAI')
                                                        <span class="text-white badge badge-success">SELESAI</span>
                                                    @else
                                                        <span class="text-white badge badge-danger">BATAL</span>
                                                    @endif
                                                </td>
                                                <td>Rp. {{ number_format($item->total_harga) }}</td>
                                                <td style="text-align: center !important;">
                                                    <a href="{{ route('produsen.transaksi.detail', $item->id) }}"
                                                        class="btn btn-sm btn-primary" style='float: left;'>Detail</a>
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
@endpush
