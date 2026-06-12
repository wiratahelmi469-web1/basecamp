<?php

namespace App\Observers;

use App\Models\Pembayaran;

class PembayaranObserver
{
    /**
     * Handle the Pembayaran "updated" event.
     */
    public function updated(Pembayaran $pembayaran): void
    {
        $oldStatus = $pembayaran->getOriginal('status');

        if (
            $oldStatus !== 'berhasil' &&
            $pembayaran->status === 'berhasil'
        ) {

            $sewa = $pembayaran->sewa;

            if (! $sewa) {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Pembayaran Sewa Berhasil
            |--------------------------------------------------------------------------
            */
            if ($pembayaran->jenis === 'sewa') {

                $sewa->updateQuietly([
                    'status' => 'dikonfirmasi',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Pembayaran Denda Berhasil
            |--------------------------------------------------------------------------
            */
            if ($pembayaran->jenis === 'denda') {

                $sewa->updateQuietly([
                    'status' => 'selesai',
                ]);
            }
        }
    }

    public function created(Pembayaran $pembayaran): void
    {
        //
    }

    public function deleted(Pembayaran $pembayaran): void
    {
        //
    }

    public function restored(Pembayaran $pembayaran): void
    {
        //
    }

    public function forceDeleted(Pembayaran $pembayaran): void
    {
        //
    }
}
