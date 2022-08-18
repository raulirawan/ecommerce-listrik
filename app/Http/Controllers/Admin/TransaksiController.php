<?php

namespace App\Http\Controllers\Admin;

use App\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
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
                            ->where('jenis_transaksi', 'KONSUMEN');
                    } else {
                        $query->with(['user'])
                            ->whereDate('created_at', $request->from_date)
                            ->where('jenis_transaksi', 'KONSUMEN');
                    }
                } else {
                    $query  = Transaksi::query();
                    if ($request->status_transaksi != 'SEMUA') {
                        $query->with(['user'])
                            ->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59'])
                            ->where('status', $request->status_transaksi)
                            ->where('jenis_transaksi', 'KONSUMEN');
                    } else {
                        $query->with(['user'])
                            ->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59'])
                            ->where('jenis_transaksi', 'KONSUMEN');
                    }
                }
            } else {
                $today = date('Y-m-d');
                $query  = Transaksi::query();
                if ($request->status_transaksi != 'SEMUA') {
                    $query->with(['user'])
                        ->whereDate('created_at', $today)
                        ->where('status', $request->status_transaksi)
                        ->where('jenis_transaksi', 'KONSUMEN');
                } else {
                    $query->with(['user'])
                        ->whereDate('created_at', $today)
                        ->where('jenis_transaksi', 'KONSUMEN');
                }
            }

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<a
                            href="' . route('detail.transaksi.admin', $item->id) . '"
                            class="btn btn-sm btn-primary"
                            >Detail</a>';
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'PENDING') {
                        return '<span class="badge bg-warning">PENDING</span>';
                    } elseif ($item->status == 'SUDAH BAYAR') {
                        return '<span class="badge bg-danger">SUDAH BAYAR</span>';
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
                ->editColumn('no_resi', function ($item) {
                    return $item->no_resi ?? 'Belum Tersedia';
                })
                ->rawColumns(['action', 'status'])
                ->make();
        }
        return view('pages.admin.transaksi.index');
    }

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
