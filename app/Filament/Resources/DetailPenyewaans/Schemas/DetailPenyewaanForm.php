<?php

namespace App\Filament\Resources\DetailPenyewaans\Schemas;

use App\Models\Produk;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Schemas\Schema;

class DetailPenyewaanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('sewa_id')
                    ->label('Transaksi Sewa')
                    ->relationship('sewa', 'kode_sewa')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('produk_id')
                    ->label('Produk')
                    ->relationship('produk', 'nama')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set) {

                        $produk = Produk::find($state);

                        if (!$produk) {
                            return;
                        }

                        $set('harga_per_hari', $produk->harga_sewa_per_hari);
                        $set('deposit', $produk->deposit);
                    })
                    ->required(),

                TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->default(1)
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {

                        $subtotal =
                            ($get('harga_per_hari') ?? 0)
                            * ($get('jumlah') ?? 0)
                            * ($get('jumlah_hari') ?? 0);

                        $set('subtotal', $subtotal);
                    })
                    ->required(),

                TextInput::make('harga_per_hari')
                    ->label('Harga per Hari')
                    ->numeric()
                    ->prefix('Rp')
                    ->readOnly()
                    ->required(),

                TextInput::make('deposit')
                    ->label('Deposit')
                    ->numeric()
                    ->prefix('Rp')
                    ->readOnly()
                    ->required(),

                TextInput::make('jumlah_hari')
                    ->label('Jumlah Hari')
                    ->numeric()
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {

                        $subtotal =
                            ($get('harga_per_hari') ?? 0)
                            * ($get('jumlah') ?? 0)
                            * ($get('jumlah_hari') ?? 0);

                        $set('subtotal', $subtotal);
                    })
                    ->required(),

                TextInput::make('subtotal')
                    ->label('Subtotal')
                    ->numeric()
                    ->prefix('Rp')
                    ->readOnly()
                    ->required(),

                Select::make('kondisi_awal')
                    ->label('Kondisi Awal')
                    ->options([
                        'baik' => 'Baik',
                        'rusak_ringan' => 'Rusak Ringan',
                        'rusak_berat' => 'Rusak Berat',
                    ])
                    ->default('baik'),

                Select::make('kondisi_akhir')
                    ->label('Kondisi Akhir')
                    ->options([
                        'baik' => 'Baik',
                        'rusak_ringan' => 'Rusak Ringan',
                        'rusak_berat' => 'Rusak Berat',
                    ]),

                Textarea::make('catatan_kondisi')
                    ->label('Catatan Kondisi')
                    ->columnSpanFull(),
            ]);
    }
}
