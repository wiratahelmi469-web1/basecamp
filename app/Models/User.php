<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
     * Hak akses panel Filament
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if (! $this->is_aktif) {
            return false;
        }

        return match ($panel->getId()) {
            'admin' => $this->role === 'admin',
            'customer' => $this->role === 'customer',
            default => false,
        };
    }

    /**
     * Kompatibel dengan package yang memanggil $user->name
     */
    public function getNameAttribute(): string
    {
        return $this->nama ?? '';
    }

    /**
     * Kompatibel dengan package yang memanggil $user->name()
     */
    public function name(): string
    {
        return $this->nama ?? '';
    }

    /**
     * Kompatibel dengan package yang memanggil $user->avatar
     */
    public function getAvatarAttribute(): string
    {
        return $this->foto
            ? asset('storage/'.$this->foto)
            : 'https://ui-avatars.com/api/?name='.urlencode($this->nama);
    }

    /**
     * Nama yang tampil di Filament
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
