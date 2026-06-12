<?php

namespace App\Observers;

use App\Models\Sewa;
use Carbon\Carbon;

class SewaObserver
{
    public function updated(Sewa $sewa): void
    {
        $oldStatus = $sewa->getOriginal('status');
        $newStatus = $sewa->status;

        /*
        |--------------------------------------------------------------------------
        | Saat barang disewa
        |--------------------------------------------------------------------------
        */
        if (
            $oldStatus !== 'disewa' &&
            $newStatus === 'disewa'
        ) {
            foreach ($sewa->detailPenyewaan as $detail) {

                $detail->produk->decrement(
                    'stok_tersedia',
                    $detail->jumlah
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Saat barang dikembalikan
        |--------------------------------------------------------------------------
        */
        if (
            $oldStatus === 'disewa' &&
            in_array($newStatus, [
                'dikembalikan',
                'selesai',
            ])
        ) {

            // Kembalikan stok
            foreach ($sewa->detailPenyewaan as $detail) {

                $detail->produk->increment(
                    'stok_tersedia',
                    $detail->jumlah
                );
            }

            // Tanggal aktual pengembalian
            $tanggalAktual = $sewa->tanggal_kembali_aktual
                ? Carbon::parse($sewa->tanggal_kembali_aktual)
                : now();

            $tanggalHarusKembali = Carbon::parse(
                $sewa->tanggal_kembali
            );

            // Hitung keterlambatan
            $terlambatHari = max(
                0,
                $tanggalHarusKembali->diffInDays(
                    $tanggalAktual,
                    false
                )
            );

            $dendaPerHari = 50000;

            $dendaTerlambat = $terlambatHari * $dendaPerHari;

            // Hitung denda kerusakan
            $dendaKerusakan = 0;

            foreach ($sewa->detailPenyewaan as $detail) {

                switch ($detail->kondisi_akhir) {

                    case 'rusak_ringan':
                        $dendaKerusakan += 100000;
                        break;

                    case 'rusak_berat':
                        $dendaKerusakan += 500000;
                        break;
                }
            }

            $totalDenda = $dendaTerlambat + $dendaKerusakan;

            // Simpan hasil
            $sewa->updateQuietly([
                'tanggal_kembali_aktual' => $tanggalAktual->toDateString(),
                'denda' => $totalDenda,
            ]);
        }
    }
}
