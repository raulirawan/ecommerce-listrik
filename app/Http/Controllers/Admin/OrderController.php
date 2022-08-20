<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Produk;
use App\Transaksi;
use App\TransaksiDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                if ($request->from_date === $request->to_date) {
                    $query  = Transaksi::query();
                    if ($request->status_transaksi != 'SEMUA') {
                        $query->with(['user'])
                            ->whereDate('created_at', $request->from_date)
                            ->where('status', $request->status_transaksi)
                            ->where('jenis_transaksi', 'SUPPLIER');
                    } else {
                        $query->with(['user'])
                            ->whereDate('created_at', $request->from_date)
                            ->where('jenis_transaksi', 'SUPPLIER');
                    }
                } else {
                    $query  = Transaksi::query();
                    if ($request->status_transaksi != 'SEMUA') {
                        $query->with(['user'])
                            ->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59'])
                            ->where('status', $request->status_transaksi)
                            ->where('jenis_transaksi', 'SUPPLIER');
                    } else {
                        $query->with(['user'])
                            ->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59'])
                            ->where('jenis_transaksi', 'SUPPLIER');
                    }
                }
            } else {
                $today = date('Y-m-d');
                $query  = Transaksi::query();
                if ($request->status_transaksi != 'SEMUA') {
                    $query->with(['user'])
                        ->whereDate('created_at', $today)
                        ->where('status', $request->status_transaksi)
                        ->where('jenis_transaksi', 'SUPPLIER');
                } else {
                    $query->with(['user'])
                        ->whereDate('created_at', $today)
                        ->where('jenis_transaksi', 'SUPPLIER');
                }
            }

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    if ($item->status == 'SEDANG DIKIRIM') {
                        return '<a
                        href="' . route('detail.transaksi.admin', $item->id) . '"
                        class="btn btn-sm btn-primary"
                        >Detail</a>
                        <a
                        data-toggle="modal"
                        id="edit"
                        data-target="#modal-edit"
                        data-id="' . $item->id . '"
                        class="btn btn-sm btn-success"
                        >Bukti Transfer</a>
                        <a
                        href="' . route('order.terima.barang', $item->id) . '"
                        onclick="return confirm(' . "'Barang Sudah Di Terima ?'" . ')"
                        class="btn btn-sm btn-info"
                        >Terima</a>
                        ';
                    } else {
                        return '<a
                        href="' . route('detail.transaksi.admin', $item->id) . '"
                        class="btn btn-sm btn-primary"
                        >Detail</a>
                        <a
                        data-toggle="modal"
                        id="edit"
                        data-target="#modal-edit"
                        data-id="' . $item->id . '"
                        class="btn btn-sm btn-success"
                        >Bukti Transfer</a>
                        ';
                    }
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'PENDING') {
                        return '<span class="badge bg-warning">PENDING</span>';
                    } elseif ($item->status == 'SUDAH BAYAR') {
                        return '<span class="badge bg-success">SUDAH BAYAR</span>';
                    } elseif ($item->status == 'SEDANG DIKIRIM') {
                        return '<span class="badge bg-warning">SEDANG DIKIRIM</span>';
                    } elseif ($item->status == 'SELESAI') {
                        return '<span class="badge bg-success">SELESAI</span>';
                    } else {
                        return '<span class="badge badge-danger">BATAL</span>';
                    }
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at;
                })
                ->editColumn('bukti_transfer', function ($item) {
                    if ($item->bukti_transfer != null) {
                        return '<img style="width: 100px;" src="' . asset($item->bukti_transfer) . '">';
                    } else {
                        return 'Tidak Ada';
                    }
                })
                ->editColumn('no_resi', function ($item) {
                    return $item->no_resi ?? 'Belum Tersedia';
                })
                ->rawColumns(['action', 'status', 'bukti_transfer'])
                ->make();
        }

        return view('pages.admin.order.index');
    }

    public function orderForm()
    {
        return view('pages.admin.order.order-form');
    }



    public function orderFormPost(Request $request)
    {
        $harga = Produk::where('id', $request->produk_id)->first()->harga_produsen;
        $cart = new Cart();

        $dataCart = Cart::where('produk_id', $request->produk_id)->where('user_id', Auth::user()->id)->first();
        if ($dataCart != null) {
            $dataCart->harga = $dataCart->harga + $harga * $request->qty;
            $dataCart->qty = $dataCart->qty + $request->qty;
            $dataCart->save();
        } else {
            $cart->user_id = Auth::user()->id;
            $cart->produk_id = $request->produk_id;
            $cart->qty = $request->qty;
            $cart->harga = $harga * $request->qty;
            $cart->save();
        }
        if ($cart != null || $dataCart != null) {
            return redirect()->back()->with('success', ' Data Keranjang Berhasil di Simpan!');
        } else {
            return redirect()->back()->with('error', ' Data Keranjang Gagal di Simpan!');
        }
    }

    public function delete($id)
    {
        $cart = Cart::where('id', $id)->first();
        if ($cart) {
            $cart->delete();
            return redirect()->back()->with('success', ' Data Keranjang Berhasil di Hapus!');
        } else {
            return redirect()->back()->with('error', ' Data Keranjang Gagal di Hapus!');
        }
    }
    public function checkoutBarang()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        if ($cart->isNotEmpty()) {
            $transaksi = new Transaksi();
            $transaksi->user_id = Auth::user()->id;
            $transaksi->kode_transaksi = 'P-' . mt_rand(0000, 9999);
            $transaksi->jenis_transaksi = 'SUPPLIER';
            $transaksi->total_harga = $cart->sum('harga');
            $transaksi->status = 'PENDING';
            $transaksi->save();

            foreach ($cart as $key => $item) {
                $transaksiDetail = new TransaksiDetail();
                $transaksiDetail->transaksi_id = $transaksi->id;
                $transaksiDetail->produk_id = $item->produk->id;
                $transaksiDetail->harga = $item->produk->harga_produsen * $item->qty;
                $transaksiDetail->qty = $item->qty;
                $transaksiDetail->save();
            }

            if ($transaksi != null && $transaksiDetail != null) {
                Cart::where('user_id', Auth::user()->id)->delete();
                return redirect()->route('order.admin.index')->with('success', 'Data Berhasil di Simpan');
            } else {
                return redirect()->route('order.admin.index')->with('error', 'Data Gagal di Simpan!');
            }
        } else {
            return redirect()->back()->with('error', ' Data Keranjang Kosong!');
        }
    }

    public function uploadBukti(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $tujuan_upload = 'image/bukti-transfer/';
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $nama_file = str_replace(' ', '', $nama_file);
            $file->move($tujuan_upload, $nama_file);

            $transaksi->bukti_transfer = $tujuan_upload . $nama_file;
        }
        $transaksi->status = 'SUDAH BAYAR';
        $transaksi->save();

        if ($transaksi != null) {
            return redirect()->route('order.admin.index')->with('success', ' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('order.admin.index')->with('error', ' Data Gagal di Simpan!');
        }
    }
    public function terimaBarang($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->status = 'SELESAI';
        $transaksi->save();
        if ($transaksi != null) {
            return redirect()->route('order.admin.index')->with('success', ' Data Berhasil di Simpan!');
        } else {
            return redirect()->route('order.admin.index')->with('error', ' Data Gagal di Simpan!');
        }
    }
}
