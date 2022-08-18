@extends('layouts.dashboard-user')

@section('title','Rincian Order')

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
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-globe"></i> TOKO MELATI | {{ $transaction->status_transaksi }}
                      <small class="float-right">Date: {{ $transaction->created_at->format('d-m-Y') }}</small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="text-bold float-right">INVOICES #{{ $transaction->kode }}</div>
                <div class="row invoice-info">
                  <div class="col-sm-6 invoice-col">
                    From
                    <address>
                      <strong>Toko Melati</strong><br>
                      Jalan Daan Mogot No.45,<br>
                      RT.9/RW.7, Semanan, Kec. Kalideres,  Jakarta Barat<br>
                      No Hp: 081298148785<br>
                      Email: serlyhartati0911@gmail.com
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    To
                    <address>
                      <strong>{{ $transaction->user->name }}</strong><br>
                      {{ $transaction->user->alamat_lengkap }}<br>
                      No Hp: {{ $transaction->user->no_hp }}<br>
                      Email: {{ $transaction->user->email }}
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
                        <th>Ukuran</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($orderDetail as $item)
                        <tr>
                            <td>{{ $item->product->nama }}</td>
                            <td>{{ $item->ukuran }}</td>
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
                          <td>Rp.{{ number_format($subTotal) }}</td>
                        </tr>
                        <tr>
                          <th>Pengiriman:</th>
                          <td>Rp.{{ number_format($totalPengiriman) }}</td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>Rp.{{ number_format($total) }}</td>
                        </tr>
                      </table>
                      
                      
                      <form method="POST" action="{{ route('upload.bukti', $transaction->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                          <label for="exampleInputEmail1">Bukti Transfer</label>
                          <input type="file" class="form-control @error('bukti_transfer') is-invalid @enderror" name="bukti_transfer">
                          <div class="invalid-feedback">
                              Masukan Bukti Transfer
                          </div>  
                        </div>
                    
                          <button type="submit" class="btn btn-primary mr-3" style="float: left">Simpan</button>
                          <a href="{{ route('transaksi.user.index') }}" class="btn btn-danger">Kembali</a>
                      </form>


                      <div class="notes mt-4">
                        <div class="text-bold">
                          Transfer Ke Nomor Rekening {{ $transaction->bank }}
                        </div>
                      </div>


                    </div>
                  </div>
                  <!-- /.col -->
                </div>
               
              </div>

              @if ($transaction->bukti_transfer != null)
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-6">
                    <h4>
                      Bukti Transfer
                    </h4>
                    <img src="{{ Storage::url($transaction->bukti_transfer) }}" style="max-width: 300px" alt="">
                  </div>
                  <!-- /.col -->
                </div>
    
                
              </div>
              @else
              <div class=""></div>
              @endif
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
@endsection
