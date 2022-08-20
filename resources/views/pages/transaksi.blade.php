@extends('layouts.app')

@section('title', 'Toko listrik')
@section('content')
    <style>
        .badge {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .badge {
                transition: none
            }
        }

        a.badge:focus,
        a.badge:hover {
            text-decoration: none
        }

        .badge:empty {
            display: none
        }

        .btn .badge {
            position: relative;
            top: -1px
        }

        .badge-pill {
            padding-right: .6em;
            padding-left: .6em;
            border-radius: 10rem
        }

        .badge-primary {
            color: #fff;
            background-color: #007bff
        }

        a.badge-primary:focus,
        a.badge-primary:hover {
            color: #fff;
            background-color: #0062cc
        }

        a.badge-primary.focus,
        a.badge-primary:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .5)
        }

        .badge-secondary {
            color: #fff;
            background-color: #6c757d
        }

        a.badge-secondary:focus,
        a.badge-secondary:hover {
            color: #fff;
            background-color: #545b62
        }

        a.badge-secondary.focus,
        a.badge-secondary:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(108, 117, 125, .5)
        }

        .badge-success {
            color: #fff;
            background-color: #28a745
        }

        a.badge-success:focus,
        a.badge-success:hover {
            color: #fff;
            background-color: #1e7e34
        }

        a.badge-success.focus,
        a.badge-success:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(40, 167, 69, .5)
        }

        .badge-info {
            color: #fff;
            background-color: #17a2b8
        }

        a.badge-info:focus,
        a.badge-info:hover {
            color: #fff;
            background-color: #117a8b
        }

        a.badge-info.focus,
        a.badge-info:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(23, 162, 184, .5)
        }

        .badge-warning {
            color: #212529;
            background-color: #ffc107
        }

        a.badge-warning:focus,
        a.badge-warning:hover {
            color: #212529;
            background-color: #d39e00
        }

        a.badge-warning.focus,
        a.badge-warning:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(255, 193, 7, .5)
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545
        }

        a.badge-danger:focus,
        a.badge-danger:hover {
            color: #fff;
            background-color: #bd2130
        }

        a.badge-danger.focus,
        a.badge-danger:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(220, 53, 69, .5)
        }

        .badge-light {
            color: #212529;
            background-color: #f8f9fa
        }

        a.badge-light:focus,
        a.badge-light:hover {
            color: #212529;
            background-color: #dae0e5
        }

        a.badge-light.focus,
        a.badge-light:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(248, 249, 250, .5)
        }

        .badge-dark {
            color: #fff;
            background-color: #343a40
        }

        a.badge-dark:focus,
        a.badge-dark:hover {
            color: #fff;
            background-color: #1d2124
        }

        a.badge-dark.focus,
        a.badge-dark:focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(52, 58, 64, .5)
        }
    </style>
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
                    @if ($errors->any())
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
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="active">Transaksi</li>
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
                <div class="col-md-12">
                    <h5>List Data Transaksi</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal Transaksi</th>
                                <th>No Resi</th>
                                <th>Kode Transaksi</th>
                                <th>Status</th>
                                <th>Ongkos Kirim</th>
                                <th>Sub Total</th>
                                <th>Total Harga</th>
                                <th>Ekspedisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (App\Transaksi::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get() as $item)
                                @php
                                    $subtotal = $item->total_harga - $item->ongkos_kirim;
                                @endphp
                                <tr>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->no_resi ?? 'Belum Ada' }}</td>
                                    <td>{{ $item->kode_transaksi }}</td>
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
                                    <td>Rp{{ number_format($item->ongkos_kirim) }}</td>
                                    <td>Rp{{ number_format($subtotal) }}</td>
                                    <td>Rp{{ number_format($item->total_harga) }}</td>
                                    <td>{{ $item->expedisi }}</td>
                                    <td>
                                        <a style="color: #fff" onclick="detailTransaction({{ $item->id }})"
                                            data-toggle="modal" data-target="#modal-detail" class="btn btn-info">Detail
                                        </a>
                                        @if ($item->status == 'PENDING')
                                            <a href="{{ url($item->link_pembayaran) }}" target="_blank"
                                                class="btn btn-success">Bayar</a>
                                        @endif
                                        @if ($item->status == 'SEDANG DIKIRIM')
                                            <a href="{{ route('transaksi.terima.barang', $item->id) }}"
                                                onclick="return confirm('Sudah Terima Barang ?')"
                                                class="btn btn-primary">Terima</a>
                                        @endif
                                        @if ($item->status == 'SELESAI')
                                            <a href="{{ route('transaksi.return.barang', $item->id) }}"
                                                onclick="return confirm('Yakin Return Barang ?')"
                                                class="btn btn-primary">Retur</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="8">Tidak Ada Data</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>

            <!-- /row -->
            {{-- return --}}
            <div class="row">
                <div class="col-md-12">
                    <h5>List Data Return Barang</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal Transaksi</th>
                                <th>No Resi</th>
                                <th>Kode Transaksi</th>
                                <th>Status</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (App\Retur::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get() as $item)
                                @php
                                    $subtotal = $item->total_harga - $item->ongkos_kirim;
                                @endphp
                                <tr>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->no_resi ?? 'Belum Ada' }}</td>
                                    <td>{{ $item->transaksi->kode_transaksi }}</td>
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
                                    <td>Rp{{ number_format($item->transaksi->total_harga) }}</td>
                                    <td>
                                        <a style="color: #fff" onclick="detailTransaction({{ $item->transaksi->id }})"
                                            data-toggle="modal" data-target="#modal-detail" class="btn btn-info">Detail
                                        </a>

                                        @if ($item->status == 'SEDANG DIKIRIM')
                                            <a href="{{ route('transaksi.return.barang.terima', $item->id) }}"
                                                onclick="return confirm('Sudah Terima Barang ?')"
                                                class="btn btn-primary">Terima</a>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="8">Tidak Ada Data</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /container -->
    </div>
    <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="margin-top: 120px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Quantity</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="data-detail"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('down-script')
    <script>
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function detailTransaction(transaction_id) {
            $('#data-detail').html('');
            $.ajax({
                url: window.location.origin + "/transaksi/detail/" + transaction_id,
                method: 'get',
                dataType: 'json',
                success: function(e) {
                    let html = '';
                    e.forEach((val, item) => {
                        html += `
                            <tr>
                                <td>${val.produk.nama_produk}</td>
                                <td>${val.qty}</td>
                                <td>Rp${numberWithCommas(val.produk.harga)}</td>
                                <td>Rp${numberWithCommas(val.harga)}</td>
                            </tr>
                        `;
                    })
                    $('#data-detail').append(html)
                },
                error: function(e) {}
            })
        }
    </script>
@endpush
