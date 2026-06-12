<?php

namespace App\Observers;

use App\Models\DetailPenyewaan;

class DetailPenyewaanObserver
{
    public function created(DetailPenyewaan $detail): void
    {
        $this->updateTotalSewa($detail);
    }

    public function updated(DetailPenyewaan $detail): void
    {
        $this->updateTotalSewa($detail);
    }

    public function deleted(DetailPenyewaan $detail): void
    {
        $this->updateTotalSewa($detail);
    }

    private function updateTotalSewa(DetailPenyewaan $detail): void
    {
        $sewa = $detail->sewa;

        $totalHarga = $sewa->detailPenyewaan()
            ->sum('subtotal');

        $totalDeposit = $sewa->detailPenyewaan()
            ->sum('deposit');

        $sewa->updateQuietly([
            'total_harga' => $totalHarga,
            'total_deposit' => $totalDeposit,
        ]);
    }
}
