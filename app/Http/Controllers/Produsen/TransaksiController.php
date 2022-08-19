<?php

namespace App\Http\Controllers\Produsen;

use App\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function detail($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('pages.admin.transaksi.detail', compact('transaksi'));
    }

    public function updateResi(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if (!$transaksi->no_resi) {
            $transaksi->status = 'SEDANG DIKIRIM';
        }
        $transaksi->no_resi = $request->no_resi;
        $transaksi->save();
        if ($transaksi != null) {
            return redirect()->route('detail.transaksi.admin', $id)->with('sukses', ' Data Resi di Update!');
        } else {
            return redirect()->route('detail.transaksi.admin', $id)->with('error', ' Data Resi Gagal di Update!');
        }
    }
}
