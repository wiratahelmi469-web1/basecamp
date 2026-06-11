<?php

namespace App\Filament\Resources\Sewas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SewaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('kode_sewa')
                    ->label('Kode Sewa')
                    ->required()
                    ->maxLength(30),

                Select::make('user_id')
                    ->label('Pelanggan')
                    ->relationship('user', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('admin_id')
                    ->label('Admin')
                    ->relationship('admin', 'nama')
                    ->searchable()
                    ->preload(),

                DatePicker::make('tanggal_sewa')
                    ->required(),

                DatePicker::make('tanggal_kembali')
                    ->required(),

                DatePicker::make('tanggal_kembali_aktual'),

                Select::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'dikonfirmasi' => 'Dikonfirmasi',
                        'disewa' => 'Disewa',
                        'dikembalikan' => 'Dikembalikan',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ])
                    ->default('menunggu')
                    ->required(),

                TextInput::make('total_harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                TextInput::make('total_deposit')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                TextInput::make('denda')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0),

                Textarea::make('catatan')
                    ->columnSpanFull(),
            ]);
    }
}
