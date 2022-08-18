@extends('layouts.dashboard-admin')

@section('title', 'Rincian Order')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Rincian Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Rincian Order</li>
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
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> LISTRIK |
                                        @if ($transaksi->status == 'PENDING')
                                            <span class="text-white badge badge-warning">PENDING</span>
                                        @elseif ($transaksi->status == 'SUDAH BAYAR')
                                            <span class="text-white badge badge-danger">SUDAH BAYAR</span>
                                        @elseif ($transaksi->status == 'SEDANG DIKIRIM')
                                            <span class="text-white badge badge-warning">SEDANG DIKIRIM</span>
                                        @elseif ($transaksi->status == 'SELESAI')
                                            <span class="text-white badge badge-success">SELESAI</span>
                                        @else
                                            <span class="text-white badge badge-danger">BATAL</span>
                                        @endif
                                        <small class="float-right">Tanggal:
                                            {{ $transaksi->created_at->format('d-m-Y') }}</small>
                                        | NOMOR RESI : {{ $transaksi->no_resi ?? 'Belum Tersedia' }}
                                    </h4>
                                </div>
                                {{-- <a href="https://api.whatsapp.com/send?phone={{ $transaksi->user->no_hp }}" target="_blank"
                                    class="btn btn-success float-right d-inline-block">Hubungi Customer</a> --}}

                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="text-bold float-right">INVOICES #{{ $transaksi->kode_transaksi }}</div>
                            <div class="row invoice-info">
                                <div class="col-sm-6 invoice-col">
                                    Pengirim
                                    <address>
                                        <strong>Toko Listrik</strong><br>
                                        Jalan Kenangan No.100,<br>
                                        RT.01/RW.03, Kebon Sayur, Kec. Tanjung Duren, Jakarta Barat<br>
                                        No Hp: 0824721342<br>
                                        Email: tokolistrik@gmail.com
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    Penerima
                                    <address>
                                        <strong>{{ $transaksi->user->name }}</strong><br>
                                        {{ $transaksi->alamat }}<br>
                                        No Hp: {{ $transaksi->user->no_hp }}<br>
                                        Email: {{ $transaksi->user->email }}
                                    </address>
                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Produk</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $transaksiDetail = App\TransaksiDetail::where('transaksi_id', $transaksi->id)->get();
                                            @endphp
                                            @foreach ($transaksiDetail as $item)
                                                <tr>
                                                    <td>{{ $item->produk->nama_produk }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>Rp.{{ number_format($item->harga) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->

                                <!-- /.col -->
                                <div class="col-12">
                                    <p class="lead">Total</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>Rp.{{ number_format($transaksiDetail->sum('harga')) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Pengiriman:</th>
                                                <td>Rp.{{ number_format($transaksi->ongkos_kirim) }}
                                                    ({{ $transaksi->expedisi }})</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>Rp.{{ number_format($transaksiDetail->sum('harga') + $transaksi->ongkos_kirim) }}
                                                </td>
                                            </tr>
                                        </table>





                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <form method="POST"
                                        action="{{ route('transaksi.admin.update.resi', $transaksi->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No Resi</label>
                                            <input type="text" name="no_resi" class="form-control"
                                                placeholder="Masukan Nomor Resi" required>

                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                                <!-- /.col -->
                            </div>

                        </div>
                        {{-- @if ($transaksi->bukti_transfer != null)
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-6">
                                        <h4>
                                            Bukti Transfer
                                        </h4>
                                        <img src="{{ Storage::url($transaksi->bukti_transfer) }}" style="max-width: 300px"
                                            alt="">
                                    </div>
                                    <!-- /.col -->
                                </div>


                            </div>
                        @else
                            <div class=""></div>
                        @endif --}}
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    @endsection
