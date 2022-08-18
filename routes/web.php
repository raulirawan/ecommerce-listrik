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
    return view('welcome');
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
    });

Route::prefix('produsen')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/dashboard', 'Produsen\DashboardController@index')->name('dashboard.supplier');
        Route::get('/produk', 'Produsen\ProdukController@index')->name('produsen.produk.index');

        Route::post('/produk/update/harga/{produk_id}', 'Produsen\ProdukController@updateHarga')->name('produsen.update.harga');
    });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
