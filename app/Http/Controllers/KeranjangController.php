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
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        if ($request->jumlah > $produk->stok_tersedia) {

            return response()->json([
                'message' => 'Stok tidak mencukupi.',
            ], 422);
        }

        Keranjang::create([
            'user_id' => auth()->id(),
            'produk_id' => $produk->id,

            'jumlah' => $request->jumlah,

            'tanggal_sewa' => $request->tanggal_sewa,

            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        $cartCount = Keranjang::where(
            'user_id',
            auth()->id()
        )->count();

        return response()->json([
            'message' => 'Produk berhasil ditambahkan ke keranjang!',
            'cart_count' => $cartCount,
        ]);
    }

    public function destroy($id)
    {
        $item = Keranjang::where('user_id', auth()->id())
            ->findOrFail($id);

        $item->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}
