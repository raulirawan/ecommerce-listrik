<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/produk/detail/{slug}', 'ProdukController@detail')->name('detail.produk');


Route::middleware(['auth'])->group(function () {
    Route::post('/tambah/keranjang/{produk_id}', 'CartController@addCart')->name('add.cart');

    Route::delete('/delete/cart/{id}', 'CartController@deleteCart')->name('delete.cart');
    Route::get('/checkout', 'CartController@checkout')->name('checkout.index');
    Route::post('/checkout', 'CartController@checkoutPost')->name('checkout.post');

    Route::get('/kota', 'CartController@getKota')->name('fetch.kota');
    Route::post('/ongkir', 'CartController@ongkir')->name('get.ongkir');

    Route::get('/profil', 'ProfilController@index')->name('profil.index');
    Route::post('/profil', 'ProfilController@update')->name('profil.update');
    Route::post('/password/update', 'ProfilController@passwordUpdate')->name('password.update.user');

    Route::get('/transaksi', 'TransaksiController@index')->name('transaksi.index');
    Route::get('/transaksi/detail/{transaksi_id}', 'TransaksiController@detail')->name('transaksi.detail');

    Route::get('/transaksi/terima/{transaksi_id}', 'TransaksiController@terima')->name('transaksi.terima.barang');
    Route::get('/transaksi/return/{transaksi_id}', 'TransaksiController@returnBarang')->name('transaksi.return.barang');
    Route::get('/transaksi/return/terima/{return_id}', 'TransaksiController@returnBarangTerima')->name('transaksi.return.barang.terima');
});

Route::prefix('admin')
    ->middleware(['supplier', 'auth'])
    ->group(function () {
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard.admin');

        Route::resource('/user', 'Admin\UserController');
        Route::resource('/produk', 'Admin\ProdukController');

        Route::get('produk/delete/gambar/{produk_id}/{key_gambar}', 'Admin\ProdukController@deleteGambar')->name('produk.gambar.delete');


        Route::get('/transaksi', 'Admin\TransaksiController@index')->name('transaksi.admin.index');
        Route::get('/transaksi/detail/{id_transaksi}', 'Admin\TransaksiController@detail')->name('detail.transaksi.admin');

        Route::post('/transaksi/update-resi/{transaksi_id}', 'Admin\TransaksiController@updateResi')->name('transaksi.admin.update.resi');



        Route::get('/order-form', 'Admin\OrderController@index')->name('order.admin.index');
        Route::get('/order-form/tambah', 'Admin\OrderController@orderForm')->name('order.form');
        Route::get('/order-form/delete/{cart_id}', 'Admin\OrderController@delete')->name('order.form.delete');
        Route::post('/order-form/tambah', 'Admin\OrderController@orderFormPost')->name('order.form.post');
        Route::get('/order-form/checkout', 'Admin\OrderController@checkoutBarang')->name('checkout.barang');
        Route::post('/order-form/upload/bukti-transfer/{transaksi_id}', 'Admin\OrderController@uploadBukti')->name('upload.bukti.transfer');

        Route::get('/order-form/terima/{transaksi_id}', 'Admin\OrderController@terimaBarang')->name('order.terima.barang');

        Route::get('/transaksi/return/detail/{return_id}', 'Admin\ReturController@detail')->name('detail.transaksi.return');
        Route::post('/transaksi/update/resi/{return_id}', 'Admin\ReturController@updateResi')->name('transaksi.update.resi.return');
    });

Route::prefix('produsen')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/dashboard', 'Produsen\DashboardController@index')->name('dashboard.supplier');
        Route::get('/produk', 'Produsen\ProdukController@index')->name('produsen.produk.index');


        Route::post('/produk/update/harga/{produk_id}', 'Produsen\ProdukController@updateHarga')->name('produsen.update.harga');
        Route::get('/detail/transaksi/{transaksi_id}', 'Produsen\TransaksiController@detail')->name('produsen.transaksi.detail');
        Route::post('/transaksi/update-resi/{transaksi_id}', 'Produsen\TransaksiController@updateResi')->name('transaksi.produsen.update.resi');
    });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
