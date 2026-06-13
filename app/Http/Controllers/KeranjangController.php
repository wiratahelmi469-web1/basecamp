<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;

class KeranjangController extends Controller
{
    public function index()
    {
        $items = Keranjang::with('produk')
            ->where('user_id', auth()->id())
            ->get();

        $totalHarga = 0;
        $totalDeposit = 0;

        foreach ($items as $item) {

            $jumlahHari =
                $item->tanggal_sewa->diffInDays($item->tanggal_kembali);

            if ($jumlahHari < 1) {
                $jumlahHari = 1;
            }

            $subtotal =
                $item->produk->harga_sewa_per_hari *
                $item->jumlah *
                $jumlahHari;

            $deposit =
                $item->produk->deposit *
                $item->jumlah;

            $totalHarga += $subtotal;
            $totalDeposit += $deposit;
        }

        return view(
            'customer.keranjang.index',
            compact(
                'items',
                'totalHarga',
                'totalDeposit'
            )
        );
    }
}
