<!DOCTYPE html>
<html lang="en" id="home">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Halaman Sukses Checkout</title>
    @include('includes.style')
  </head>

  <body>
   
    <div class="page-content page-success" style="padding-top: 70px">
        <div class="container">
        <div
            class="row align-items-center row-success justify-content-center"
            data-aos="zoom-in"
        >
            <div class="col-lg-6 text-center">
            <div class="img-success">
                <img
                src="{{ url('frontend/img/success.svg') }}"
                class="w-50"
                style="max-width: 50%"
                alt="Image Success"
                />
                <h2 class="text-center mt-5">Oke! <br />Transaksi Anda Berhasil!</h2>
                <div class="message text-center">
                <p>Silahkan Lakukan Pembayaran <br/>Dan Melakukan Konfirmasi Pembayaran</p>
                </div>
    
                <a href="{{ route('transaksi.user.index') }}" class="btn btn-info px-5">
                Menu Transaksi</a
                >
            </div>
            </div>
        </div>
        </div>
        </div>

    <!-- Bootstrap core JavaScript -->
   @include('includes.script')
  </body>
</html>
