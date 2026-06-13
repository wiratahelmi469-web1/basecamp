<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')
            ->latest()
            ->paginate(12);

        return view('customer.produk.index', compact('produks'));
    }

    public function show(Produk $produk)
    {
        return view('customer.produk.show', compact('produk'));
    }
}
