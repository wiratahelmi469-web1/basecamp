<?php

namespace App\Filament\Customer\Resources\Produks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kategori_id')
                    ->relationship('kategori', 'id')
                    ->required(),
                TextInput::make('kode_produk')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                Textarea::make('deskripsi')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('merek')
                    ->default(null),
                TextInput::make('stok_total')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('stok_tersedia')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('harga_sewa_per_hari')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('deposit')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('kondisi')
                    ->options([
            'baik' => 'Baik',
            'rusak_ringan' => 'Rusak ringan',
            'rusak_berat' => 'Rusak berat',
            'tidak_aktif' => 'Tidak aktif',
        ])
                    ->default('baik')
                    ->required(),
                TextInput::make('foto')
                    ->default(null),
            ]);
    }
}
