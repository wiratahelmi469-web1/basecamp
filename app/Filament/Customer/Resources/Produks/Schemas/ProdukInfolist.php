<?php

namespace App\Filament\Customer\Resources\Produks\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProdukInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informasi Produk')
                    ->schema([

                        ImageEntry::make('foto')
                            ->label('Foto Produk')
                            ->disk('public'),

                        TextEntry::make('nama')
                            ->label('Nama Produk'),

                        TextEntry::make('kategori.nama')
                            ->label('Kategori')
                            ->badge(),

                        TextEntry::make('merek')
                            ->label('Merek'),

                        TextEntry::make('kondisi')
                            ->badge(),

                    ])
                    ->columns(2),

                Section::make('Stok & Harga')
                    ->schema([

                        TextEntry::make('stok_tersedia')
                            ->label('Stok Tersedia'),

                        TextEntry::make('harga_sewa_per_hari')
                            ->label('Harga Sewa / Hari')
                            ->money('IDR'),

                        TextEntry::make('deposit')
                            ->label('Deposit')
                            ->money('IDR'),

                    ])
                    ->columns(3),

                Section::make('Deskripsi')
                    ->schema([

                        TextEntry::make('deskripsi')
                            ->placeholder('Tidak ada deskripsi')
                            ->columnSpanFull(),

                    ]),
            ]);
    }
}
