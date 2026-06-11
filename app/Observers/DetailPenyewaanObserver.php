<?php

namespace App\Observers;

use App\Models\DetailPenyewaan;

class DetailPenyewaanObserver
{
    private function updateTotalSewa(DetailPenyewaan $detail): void
    {
        $sewa = $detail->sewa;

        if (!$sewa) {
            return;
        }

        $totalHarga = $sewa->detailPenyewaan()->sum('subtotal');

        $totalDeposit = $sewa->detailPenyewaan()->sum('deposit');

        $sewa->updateQuietly([
            'total_harga' => $totalHarga,
            'total_deposit' => $totalDeposit,
        ]);
    }

    public function created(DetailPenyewaan $detailPenyewaan): void
    {
        $this->updateTotalSewa($detailPenyewaan);
    }

    public function updated(DetailPenyewaan $detailPenyewaan): void
    {
        $this->updateTotalSewa($detailPenyewaan);
    }

    public function deleted(DetailPenyewaan $detailPenyewaan): void
    {
        $this->updateTotalSewa($detailPenyewaan);
    }

    public function restored(DetailPenyewaan $detailPenyewaan): void
    {
        $this->updateTotalSewa($detailPenyewaan);
    }

    public function forceDeleted(DetailPenyewaan $detailPenyewaan): void
    {
        $this->updateTotalSewa($detailPenyewaan);
    }
}
