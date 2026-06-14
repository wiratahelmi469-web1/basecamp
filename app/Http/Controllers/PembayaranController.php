<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Sewa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function create(Sewa $sewa)
    {
        return view(
            'customer.pembayaran.create',
            compact('sewa')
        );
    }

    public function store(
        Request $request,
        Sewa $sewa
    ) {
        $request->validate([
            'metode' => 'required',
            'bukti_bayar' => 'required|image|max:2048',
            'catatan' => 'nullable',
        ]);

        $path = $request
            ->file('bukti_bayar')
            ->store('pembayaran', 'public');

        Pembayaran::create([
            'sewa_id' => $sewa->id,
            'kode_pembayaran' => 'PAY-'.now()->format('YmdHis'),

            'jenis' => 'sewa',

            'metode' => $request->metode,

            'jumlah' => $sewa->total_harga +
                $sewa->total_deposit,

            'status' => 'menunggu',

            'bukti_bayar' => $path,

            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('pesanan.show', $sewa->id)
            ->with(
                'success',
                'Bukti pembayaran berhasil dikirim'
            );
    }
}
