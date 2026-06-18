<?php

namespace App\Http\Controllers;

use App\Models\DetailPenyewaan;
use App\Models\Keranjang;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $selectedItems = $request->selected_items ?? [];

        if (empty($selectedItems)) {
            return redirect()
                ->route('keranjang.index')
                ->with(
                    'error',
                    'Pilih minimal 1 produk untuk checkout.'
                );
        }

        $items = Keranjang::with('produk')
            ->where('user_id', auth()->id())
            ->whereIn('id', $selectedItems)
            ->get();

        if ($items->isEmpty()) {
            return redirect()
                ->route('keranjang.index')
                ->with(
                    'error',
                    'Tidak ada produk yang dipilih.'
                );
        }

        $sewa = null;

        DB::transaction(function () use ($items, &$sewa) {

            $totalHarga = 0;
            $totalDeposit = 0;

            $sewa = Sewa::create([
                'kode_sewa' => 'SW-' . now()->format('YmdHis'),
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

                $item->produk->decrement(
                    'stok_tersedia',
                    $item->jumlah
                );
            }

            $sewa->update([
                'total_harga' => $totalHarga,
                'total_deposit' => $totalDeposit,
            ]);

            Keranjang::whereIn(
                'id',
                $items->pluck('id')
            )->delete();
        });

        return redirect()
            ->route(
                'pesanan.show',
                $sewa->id
            )
            ->with(
                'success',
                'Pesanan berhasil dibuat.'
            );
    }
}
