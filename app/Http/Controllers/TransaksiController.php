<?php

namespace App\Http\Controllers;

use App\Retur;
use App\Transaksi;
use App\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->transaction_status == 'settlement') {
            alert()->success('success', 'Transaksi Berhasil, Kode Transaksi ' . $request->order_id);
        }
        return view('pages.transaksi');
    }

    public function detail($id)
    {
        $transaksi = TransaksiDetail::with(['produk', 'transaksi'])->where('transaksi_id', $id)->get();
        return response()->json($transaksi);
    }

    public function terima($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'SELESAI';
        $transaksi->save();

        if ($transaksi) {
            alert()->success('success', 'Berhasil Terima Barang');
            return redirect()->route('transaksi.index');
        } else {
            alert()->error('error', 'Gagal Terima Barang');
            return redirect()->route('transaksi.index');
        }
    }

    public function returnBarang($id)
    {
        $retur = new Retur();
        $retur->user_id = Auth::user()->id;
        $retur->transaksi_id = $id;
        $retur->status = 'PENDING';
        $retur->save();

        if ($retur) {
            alert()->success('success', 'Berhasil Tambah Data Return');
            return redirect()->route('transaksi.index');
        } else {

            alert()->error('error', 'Gagal Tambah Data Return');
            return redirect()->route('transaksi.index');
        }
    }

    public function returnBarangTerima($id)
    {
        $retur = Retur::findOrFail($id);
        $retur->status = 'SELESAI';
        $retur->save();

        if ($retur) {
            alert()->success('success', 'Berhasil Terima Data Return');
            return redirect()->route('transaksi.index');
        } else {

            alert()->error('error', 'Gagal Terima Data Return');
            return redirect()->route('transaksi.index');
        }
    }
}
