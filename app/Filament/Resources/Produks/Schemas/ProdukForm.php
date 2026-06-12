<?php

namespace App\Filament\Resources\Produks\Schemas;

use Filament\Forms\Components\FileUpload;
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
                    ->label('Kategori')
                    ->relationship('kategori', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('kode_produk')
                    ->label('Kode Produk')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(30),

                TextInput::make('nama')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(150),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->columnSpanFull(),

                TextInput::make('merek')
                    ->label('Merek')
                    ->maxLength(100),

                TextInput::make('stok_total')
                    ->label('Stok Total')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                TextInput::make('stok_tersedia')
                    ->label('Stok Tersedia')
                    ->numeric()
                    ->minValue(0)
                    ->required(),

                TextInput::make('harga_sewa_per_hari')
                    ->label('Harga Sewa / Hari')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                TextInput::make('deposit')
                    ->label('Deposit')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Select::make('kondisi')
                    ->label('Kondisi')
                    ->options([
                        'baik' => 'Baik',
                        'rusak_ringan' => 'Rusak Ringan',
                        'rusak_berat' => 'Rusak Berat',
                        'tidak_aktif' => 'Tidak Aktif',
                    ])
                    ->default('baik')
                    ->required(),

                FileUpload::make('foto')
                    ->label('Foto Produk')
                    ->image()
                    ->directory('produk')
                    ->imageEditor()
                    ->disk('public')
                    ->visibility('public'),
            ]);
    }
}
