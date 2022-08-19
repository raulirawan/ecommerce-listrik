<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Retur;
use Illuminate\Http\Request;

class ReturController extends Controller
{
    public function detail($id)
    {
        $retur = Retur::findOrFail($id);

        return view('pages.admin.retur.detail', compact('retur'));
    }

    public function updateResi(Request $request, $id)
    {
        $retur = Retur::findOrFail($id);
        $retur->no_resi = $request->no_resi;
        $retur->status = 'SEDANG DIKIRIM';
        $retur->save();
        if ($retur != null) {
            return redirect()->route('detail.transaksi.return', $id)->with('sukses', ' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('detail.transaksi.return', $id)->with('error', ' Data Gagal di Simpan!');
        }
    }
}
