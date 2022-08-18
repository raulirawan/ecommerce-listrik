<?php

namespace App\Http\Controllers\Admin;

use App\Produk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('pages.admin.produk.index', compact('produk'));
    }

    public function create()
    {
        return view('pages.admin.produk.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'gambar.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'gambar.*.mimes' => 'Gambar Harus Bertipe PNG, JPG, JPEG atau BMP',
            ]
        );

        $data = new Produk();
        $data->nama_produk = $request->nama_produk;
        $data->slug = Str::slug($request->nama_produk);
        $data->stok = $request->stok;
        $data->deskripsi = $request->deskripsi;
        $data->harga = $request->harga;
        $data->is_pre_order = $request->is_pre_order;


        if ($request->hasFile('gambar')) {
            $dataGambar = [];
            foreach ($request->file('gambar') as $key => $val) {
                $tujuan_upload = 'image/produk/';
                $nama_file = time() . "_" . $val->getClientOriginalName();
                $nama_file = str_replace(' ', '', $nama_file);
                $val->move($tujuan_upload, $nama_file);

                $dataGambar[] = $tujuan_upload . $nama_file;
            }

            $gambar = json_encode($dataGambar);
            $data->gambar = $gambar;
        }
        $data->save();

        if ($data != null) {
            return redirect()->route('produk.index')->with('sukses', ' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('produk.index')->with('error', ' Data Gagal di Simpan!');
        }
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('pages.admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'gambar.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'gambar.*.mimes' => 'Gambar Harus Bertipe PNG, JPG, JPEG atau BMP',
            ]
        );

        $data = Produk::findOrFail($id);
        $data->nama_produk = $request->nama_produk;
        $data->slug = Str::slug($request->nama_produk);
        $data->stok = $request->stok;
        $data->deskripsi = $request->deskripsi;
        $data->harga = $request->harga;
        $data->is_pre_order = $request->is_pre_order;


        if ($request->hasFile('gambar')) {
            $dataGambar = [];
            foreach ($request->file('gambar') as $key => $val) {
                $tujuan_upload = 'image/produk/';
                $nama_file = time() . "_" . $val->getClientOriginalName();
                $nama_file = str_replace(' ', '', $nama_file);
                $val->move($tujuan_upload, $nama_file);

                $dataGambar[] = $tujuan_upload . $nama_file;
            }
            if ($data->gambar != null) {
                $oldGambar = json_decode($data->gambar);
                $newGambar = array_merge($oldGambar, $dataGambar);
                $gambar = json_encode($newGambar);
            } else {
                $gambar = json_encode($dataGambar);
            }

            $data->gambar = $gambar;
        }
        $data->save();

        if ($data != null) {
            return redirect()->route('produk.index')->with('sukses', ' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('produk.index')->with('error', ' Data Gagal di Simpan!');
        }
    }

    public function destroy($id)
    {
        $data = Produk::findOrFail($id);
        if ($data != null) {
            $gambar = json_decode($data->gambar);
            foreach ($gambar as $value) {
                if (file_exists($value)) {
                    unlink($value);
                }
            }
            $data->delete();
            return redirect()->route('produk.index')->with('sukses', ' Data Berhasil di Hapus!');
        } else {
            return redirect()->route('produk.index')->with('error', ' Data Gagal di Hapus!');
        }
    }

    public function deleteGambar($id_produk, $keyGambar)
    {
        $data = Produk::findOrFail($id_produk);

        $gambar = json_decode($data->gambar);
        $gambarBaru = [];

        foreach ($gambar as $key => $value) {
            if ($key == $keyGambar) {
                if (file_exists($value)) {
                    unlink($value);
                }
                unset($value);
            } else {
                $gambarBaru[] = $value;
            }
        }

        $data->gambar = json_encode($gambarBaru);
        $data->save();

        if ($data != null) {
            return redirect()->route('produk.edit', $id_produk)->with('sukses', ' Data Berhasil di Hapus!');
        } else {
            return redirect()->route('produk.edit', $id_produk)->with('error', ' Data Gagal di Hapus!');
        }
    }
}
