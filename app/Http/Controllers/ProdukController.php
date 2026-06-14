<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $query = Produk::with('kategori');

        if (request()->filled('kategori')) {

            $query->where(
                'kategori_id',
                request('kategori')
            );
        }

        $produks = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view(
            'customer.produk.index',
            compact('produks')
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
