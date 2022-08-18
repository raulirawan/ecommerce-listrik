<?php

namespace App\Http\Controllers\Produsen;

use App\Http\Controllers\Controller;
use App\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();

        return view('pages.produsen.produk.index', compact('produk'));
    }

    public function updateHarga(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->harga_produsen = $request->harga_produsen;
        $produk->save();
        if ($produk != null) {
            return redirect()->route('produsen.produk.index')->with('sukses', ' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('produsen.produk.index')->with('error', ' Data Gagal di Simpan!');
        }
    }
}
