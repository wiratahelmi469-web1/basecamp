<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPenyewaan extends Model
{
    protected $table = 'detail_penyewaan';

    public $timestamps = false;

    protected $fillable = [
        'sewa_id',
        'produk_id',
        'jumlah',
        'harga_per_hari',
        'deposit',
        'jumlah_hari',
        'subtotal',
        'kondisi_awal',
        'kondisi_akhir',
        'catatan_kondisi',
    ];

    public function sewa(): BelongsTo
    {
        return $this->belongsTo(Sewa::class, 'sewa_id');
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
