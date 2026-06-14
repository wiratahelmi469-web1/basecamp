<?php

namespace App\Http\Controllers;

use App\Models\DetailPenyewaan;
use App\Models\Keranjang;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store()
    {
        $items = Keranjang::with('produk')
            ->where('user_id', auth()->id())
            ->get();

        if ($items->isEmpty()) {

            return redirect()
                ->route('keranjang.index')
                ->with(
                    'error',
                    'Keranjang masih kosong.'
                );
        }

        $sewa = null;

        DB::transaction(function () use ($items, &$sewa) {

            $totalHarga = 0;
            $totalDeposit = 0;

            $sewa = Sewa::create([
                'kode_sewa' => 'SW-'.now()->format('YmdHis'),
                'user_id' => auth()->id(),
                'tanggal_sewa' => $items->first()->tanggal_sewa,
                'tanggal_kembali' => $items->first()->tanggal_kembali,
                'status' => 'menunggu',
                'total_harga' => 0,
                'total_deposit' => 0,
            ]);

            foreach ($items as $item) {

                $jumlahHari = Carbon::parse(
                    $item->tanggal_sewa
                )->diffInDays(
                    Carbon::parse($item->tanggal_kembali)
                );

                if ($jumlahHari < 1) {
                    $jumlahHari = 1;
                }

                $subtotal =
                    $item->produk->harga_sewa_per_hari *
                    $item->jumlah *
                    $jumlahHari;

                DetailPenyewaan::create([
                    'sewa_id' => $sewa->id,
                    'produk_id' => $item->produk_id,
                    'jumlah' => $item->jumlah,
                    'harga_per_hari' => $item->produk->harga_sewa_per_hari,
                    'deposit' => $item->produk->deposit,
                    'jumlah_hari' => $jumlahHari,
                    'subtotal' => $subtotal,
                    'kondisi_awal' => 'baik',
                ]);

                $totalHarga += $subtotal;

                $totalDeposit +=
                    $item->produk->deposit *
                    $item->jumlah;

                // Kurangi stok tersedia
                $item->produk->decrement(
                    'stok_tersedia',
                    $item->jumlah
                );
            }

            $sewa->update([
                'total_harga' => $totalHarga,
                'total_deposit' => $totalDeposit,
            ]);

            Keranjang::where(
                'user_id',
                auth()->id()
            )->delete();
        });

        return redirect()
            ->route(
                'pesanan.show',
                $sewa->id
            );
    }
}
