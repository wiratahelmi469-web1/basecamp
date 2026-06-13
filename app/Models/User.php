<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_telepon',
        'alamat',
        'foto',
        'role',
        'is_aktif',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_aktif' => 'boolean',
        ];
    }

    /**
     * Hak akses panel Filament.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if (! $this->is_aktif) {
            return false;
        }

        return match ($panel->getId()) {
            'admin'    => $this->role === 'admin',
            'customer' => $this->role === 'customer',
            default    => false,
        };
    }

    /**
     * Agar Filament tetap menemukan atribut "name".
     */
    public function getNameAttribute(): string
    {
        return $this->nama ?? '';
    }

    /**
     * Nama yang tampil di panel Filament.
     */
    public function getFilamentName(): string
    {
        return $this->nama ?? '';
    }

    public function keranjang(): HasMany
    {
        return $this->hasMany(Keranjang::class);
    }
}
