<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller
{
    public function index()
    {
        $query = Produk::with('kategori');

        if (request()->filled('search')) {
            $query->where('nama', 'like', '%' . request('search') . '%');
        }

        if (request()->filled('kategori')) {
            $query->where('kategori_id', request('kategori'));
        }

        $produks = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama')->get();

        return view(
            'customer.produk.index',
            compact('produks', 'kategoris')
        );
    }

    public function show(Produk $produk)
    {
        return view(
            'customer.produk.show',
            compact('produk')
        );
    }
}
