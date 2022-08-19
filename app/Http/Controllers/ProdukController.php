<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    public function detail($slug)
    {
        $produk = Produk::where('slug', $slug)->firstOrFail();


        return view('pages.product-detail', compact('produk'));
    }
}
