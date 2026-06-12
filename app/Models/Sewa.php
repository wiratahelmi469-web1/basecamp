<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sewa extends Model
{
    protected $table = 'sewa';

    protected $fillable = [
        'kode_sewa',
        'user_id',
        'admin_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'tanggal_kembali_aktual',
        'status',
        'total_harga',
        'total_deposit',
        'denda',
        'catatan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function detailPenyewaan()
    {
        return $this->hasMany(
            DetailPenyewaan::class,
            'sewa_id'
        );
    }

    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'sewa_id');
    }
}
