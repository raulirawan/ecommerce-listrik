@extends('layouts.app')

@section('title', 'Toko Listrik')
@section('content')


    <div class="row">
        <div class="col-12">

        </div>
    </div>
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Checkout</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="active">Checkout</li>
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

                <div class="col-md-7">
                    <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Informasi Pengiriman</h3>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="name" value="{{ Auth::user()->name }}"
                                placeholder="Nama Lengkap" readonly>
                        </div>
                        <div class="form-group">
                            <input class="input" type="email" name="email" value="{{ Auth::user()->email }}"
                                placeholder="Email"readonly>
                        </div>
                        <div class="form-group">
                            <input class="input" type="no_hp" name="no_hp" value="{{ Auth::user()->no_hp }}"
                                placeholder="Nomor Handphone"readonly>
                        </div>
                        <div class="form-group">
                            <select id="provinsi" class="form-control" name="provinsi" required>
                                <option value="">Pilih Provinsi</option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->province_id }}">{{ $item->province }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="kota" class="form-control" name="kota" required>
                                <option value="">Pilih Kota</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="kurir" class="form-control" name="kurir" required disabled>
                                <option value="">Pilih Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="layanan" class="form-control" name="layanan" required disabled>
                                <option value="">Pilih Layanan</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat Lengkap"></textarea>
                        </div>

                    </div>

                </div>

                <!-- Order Details -->
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Orderan Anda</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUK</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        <div class="order-products">
                            @php
                                $carts = App\Cart::where('user_id', Auth::user()->id)->get();
                            @endphp
                            @foreach ($carts as $cart)
                                <div class="order-col">
                                    <div>{{ $cart->qty }}x {{ $cart->produk->nama_produk }}</div>
                                    <div>Rp{{ number_format($cart->harga) }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="order-col" id="ongkos_kirim" style="display: none">
                            <div>Ongkos Kirim</div>
                            {{-- <div><strong>FREE</strong></div> --}}
                        </div>
                        {{-- <tr id="ongkos_kirim" class="d-none">
                            <td class="text-black font-weight-bold"><strong>Ongkos Kirim</strong></td>
                        </tr> --}}
                        <div class="order-col">
                            <div><strong>SUB TOTAL</strong></div>
                            <div><strong class="order-total">Rp{{ number_format($carts->sum('harga')) }}</strong></div>
                        </div>
                        <div id="total-col" class="order-col" style="display: none">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total" id="total"></strong></div>
                        </div>
                        <input type="hidden" value="{{ $carts->sum('harga') }}" id="sub_total">

                        {{-- <tr class="d-none" id="total-tr">
                            <td class="text-black font-weight-bold"><strong>Total</strong></td>
                            <td class="text-black font-weight-bold"><strong id="total"></strong></td>
                        </tr> --}}
                    </div>
                    {{-- <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1">
                            <label for="payment-1">
                                <span></span>
                                Direct Bank Transfer
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-2">
                            <label for="payment-2">
                                <span></span>
                                Cheque Payment
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-3">
                            <label for="payment-3">
                                <span></span>
                                Paypal System
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="terms">
                        <label for="terms">
                            <span></span>
                            I've read and accept the <a href="#">terms & conditions</a>
                        </label>
                    </div> --}}
                    <button class="btn btn-block primary-btn" id="buat-pesanan">Buat Pesanan</button>
                </div>
                <!-- /Order Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


@endsection

@push('down-script')
    <script>
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        $('#provinsi').on('change', function(e) {
            var provinsi_id = e.target.value;
            $('#kota').empty();
            $('#kota').append('<option value="0" disable="true" selected="true">Pilih Kota</option>');
            $.get('/kota?province=' + provinsi_id, function(data) {
                $.each(data, function(index, kota) {
                    $('#kota').append('<option value="' + kota.city_id + '">' + kota.city_name +
                        '</option>');
                })
            });
        });

        $('#kota').on('change', function(e) {
            $("#kurir").prop('disabled', false);
        });
        $('#kurir').on('change', function(e) {
            $('#ongkos_kirim').css('display', 'none');
            $('#total-tr').css('display', 'none');
            $("#kurir").prop('disabled', false);
            var provinsi_id = $('select[name=provinsi] option').filter(':selected').val();
            var kota_id = $('select[name=kota] option').filter(':selected').val();
            var kurir = $('select[name=kurir] option').filter(':selected').val();
            $('#layanan').empty();
            $('#layanan').append(
                '<option value="0" disable="true" selected="true">Pilih Layanan</option>');
            $.ajax({
                type: "POST",
                url: "{{ route('get.ongkir') }}",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                data: {
                    "provinsi_id": provinsi_id,
                    "kota_id": kota_id,
                    "kurir": kurir,
                },
                dataType: 'json',
                success: function(response) {
                    $('#layanan').prop('disabled', false);
                    let html = '';
                    var data = response.costs;
                    $.each(data, function(index, value) {
                        var value = data[index].cost[0].value;
                        html += `
                            <option value="${value}" disable="true">${data[index].service} (${numberWithCommas(value)})</option>
                        `;
                    });
                    $('#layanan').append(html);
                }
            });
        });

        $('#layanan').on('change', function(e) {
            $('#text-ongkir').remove();
            $('#ongkir').remove();
            var layanan = $('select[name=layanan] option').filter(':selected').val();
            let html = '';
            html += `
                <div id="text-ongkir"><strong>Rp${numberWithCommas(layanan)}</strong>
                <input type="hidden"  id="ongkir" value="${layanan}"
                    </div>
                `;
            $('#ongkos_kirim').css('display', 'inline-table');
            $('#ongkos_kirim').append(html);
            var ongkir = parseInt($("#ongkir").val());
            var sub_total = parseInt($("#sub_total").val());
            var total_harga = ongkir + sub_total;
            alert(total_harga);
            $('#total-col').css('display', 'inline-table');
            $('#total').text('Rp' + numberWithCommas(total_harga));
        });

        $('#buat-pesanan').on('click', function(e) {
            if (confirm("Buat Pesanan ?")) {
                var ongkir = parseInt($("#ongkir").val());
                var alamat = $("#alamat").val();
                var provinsi = $('select[name=provinsi] option').filter(':selected').text();
                var provinsiVal = $('select[name=provinsi] option').filter(':selected').val();
                var kota = $('select[name=kota] option').filter(':selected').text();
                var kotaVal = $('select[name=kota] option').filter(':selected').val();
                var kurir = $('select[name=kurir] option').filter(':selected').val();
                var layanan = $('select[name=layanan] option').filter(':selected').text();
                if (provinsiVal == '') {
                    alert('Provinsi Tidak Boleh Kosong!');
                    return false;
                }
                if (kotaVal == '') {
                    alert('Kota Tidak Boleh Kosong!');
                    return false;
                }
                if (alamat.length == 0) {
                    alert('Alamat Tidak Boleh Kosong!');
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: "{{ route('checkout.post') }}",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    data: {
                        "ongkir": ongkir,
                        "alamat": alamat,
                        "provinsi": provinsi,
                        "kota": kota,
                        "kurir": kurir,
                        "layanan": layanan,
                    },
                    dataType: 'json',
                    success: function(result, textStatus, jqXHR) {
                        if (result.status == 'success') {
                            alert(result.message);
                            window.location.replace(result.url);
                        } else {
                            alert(result.message);
                            window.location.replace(result.url);
                        }
                    }
                });
            }
        });
    </script>
@endpush
