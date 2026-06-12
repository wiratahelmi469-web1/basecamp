<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    public $timestamps = false;

    protected $fillable = [
        'sewa_id',
        'kode_pembayaran',
        'jenis',
        'metode',
        'jumlah',
        'status',
        'bukti_bayar',
        'catatan',
        'dibayar_pada',
    ];

    protected $casts = [
        'dibayar_pada' => 'datetime',
    ];

    public function sewa(): BelongsTo
    {
        return $this->belongsTo(Sewa::class, 'sewa_id');
    }
}
