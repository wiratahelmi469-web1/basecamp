<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
     * Izinkan hanya admin yang aktif mengakses Filament.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin' && $this->is_aktif;
    }

    /**
     * Membuat atribut "name" virtual karena Filament
     * secara default mencari kolom name.
     */
    public function getNameAttribute(): string
    {
        return $this->nama ?? '';
    }

    /**
     * Nama yang ditampilkan di Filament.
     */
    public function getFilamentName(): string
    {
        return $this->nama ?? '';
    }
}
