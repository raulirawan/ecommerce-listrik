@extends('layouts.dashboard-admin')

@section('title', 'Halaman Order')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Order</li>
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
                                <h3 class="card-title">Data Order</h3>
                            </div>
                            <div class="row input-daterange ml-2 mt-2">
                                <div class="col-md-3">
                                    <input type="date" name="from_date" id="from_date"
                                        value="{{ date('Y-m-d', strtotime('-7 days')) }}" class="form-control"
                                        placeholder="From Date" />
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="to_date" id="to_date" value="{{ date('Y-m-d') }}"
                                        class="form-control" placeholder="To Date" />
                                </div>
                                <div class="col-md-3">
                                    <select name="status_transaksi" id="status_transaksi" class="form-control">
                                        <option value="SEMUA">SEMUA</option>
                                        <option value="SELESAI">SELESAI</option>
                                        <option value="PENDING">PENDING</option>
                                        <option value="SUDAH BAYAR">SUDAH BAYAR</option>
                                        <option value="SEDANG DIKIRIM">SEDANG DIKIRIM</option>
                                        <option value="BATAL">BATAL</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="filter" id="filter"
                                        class="btn btn-primary">Filter</button>
                                    <button type="button" name="refresh" id="refresh"
                                        class="btn btn-default">Refresh</button>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <a href="{{ route('order.form') }}" class="btn btn-primary mb-2">(+) Order Barang</a>

                                <table id="table-data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">Tanggal Transaksi</th>
                                            <th>Kode Transaksi</th>
                                            <th>No Resi</th>
                                            <th>Status</th>
                                            <th>Bukti Transfer</th>
                                            <th>Total Harga</th>
                                            <th style="width: 15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th id="total"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                {{-- {!! $dataTable->table() !!} --}}
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
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="form-edit" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Bukti Transfer</label>
                            <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@push('down-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endpush
@push('down-script')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {{-- {!! $dataTable->scripts() !!} --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '#edit', function() {
                var id = $(this).data('id');
                $('#form-edit').attr('action', '/admin/order-form/upload/bukti-transfer/' + id);
            });

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            var status_transaksi = $('select[name=status_transaksi] option').filter(':selected').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            load_data(from_date, to_date, status_transaksi);

            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                var status_transaksi = $('select[name=status_transaksi] option').filter(':selected').val();
                if (from_date != '' && to_date != '') {
                    $('#table-data').DataTable().destroy();
                    load_data(from_date, to_date, status_transaksi);
                } else {
                    alert('Silahkan Pilih Tanggal')
                }
            });
            $('#refresh').click(function() {
                var status_transaksi = $('select[name=status_transaksi] option').filter(':selected').val();
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                $('#table-data').DataTable().destroy();
                load_data(from_date, to_date, status_transaksi);
            });

            function load_data(from_date = '', to_date = '', status_transaksi) {
                var datatable = $('#table-data').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    ajax: {
                        url: '{!! url()->current() !!}',
                        type: 'GET',
                        data: {
                            from_date: from_date,
                            to_date: to_date,
                            status_transaksi: status_transaksi,
                        }
                    },
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'potrait',
                            footer: true,
                        },
                        {
                            extend: 'excelHtml5',
                            footer: true,
                        }
                    ],
                    order: [
                        [0, 'desc']
                    ],
                    columns: [{
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'kode_transaksi',
                            name: 'kode_transaksi'
                        },
                        {
                            data: 'no_resi',
                            name: 'no_resi'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'bukti_transfer',
                            name: 'bukti_transfer'
                        },
                        {
                            data: 'total_harga',
                            name: 'total_harga',
                            render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searcable: false,
                            width: '20%',
                        }
                    ],
                    "footerCallback": function(row, data) {
                        var api = this.api(),
                            data;
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };
                        total = api
                            .column(5)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        // Total over this page
                        price = api
                            .column(5, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        $(api.column(5).footer()).html(
                            'Rp' + price
                        );
                        var numFormat = $.fn.dataTable.render.number('\,', 'Rp').display;
                        $(api.column(5).footer()).html(
                            'Rp ' + numFormat(price)
                        );
                    }
                });
            }
        });
    </script>
@endpush
