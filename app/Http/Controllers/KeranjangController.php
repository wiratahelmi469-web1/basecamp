<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $items = Keranjang::with('produk')
            ->where('user_id', auth()->id())
            ->get();

        $totalHarga   = 0;
        $totalDeposit = 0;

        foreach ($items as $item) {
            $jumlahHari = $item->tanggal_sewa->diffInDays($item->tanggal_kembali);
            if ($jumlahHari < 1) $jumlahHari = 1;

            $totalHarga   += $item->produk->harga_sewa_per_hari * $item->jumlah * $jumlahHari;
            $totalDeposit += $item->produk->deposit * $item->jumlah;
        }

        return view('customer.keranjang.index', compact(
            'items',
            'totalHarga',
            'totalDeposit'
        ));
    }

    public function store(Request $request)
    {
        $produk = Produk::findOrFail($request->produk_id);

        $keranjang = Keranjang::where('user_id', auth()->id())
            ->where('produk_id', $produk->id)
            ->first();

        if ($keranjang) {
            $keranjang->increment('jumlah');
        } else {
            Keranjang::create([
                'user_id'         => auth()->id(),
                'produk_id'       => $produk->id,
                'jumlah'          => 1,
                'tanggal_sewa'    => now(),
                'tanggal_kembali' => now()->addDay(),
            ]);
        }

        $cartCount = Keranjang::where('user_id', auth()->id())->count();

        // Kalau request AJAX → return JSON
        if ($request->expectsJson()) {
            return response()->json([
                'message'    => 'Produk berhasil ditambahkan ke keranjang!',
                'cart_count' => $cartCount,
            ]);
        }

        // Fallback biasa (form POST)
        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
}
