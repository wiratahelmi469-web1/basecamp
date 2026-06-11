<?php

namespace App\Filament\Resources\Pembayarans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PembayaranForm
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

                TextInput::make('kode_pembayaran')
                    ->label('Kode Pembayaran')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50),

                Select::make('jenis')
                    ->label('Jenis Pembayaran')
                    ->options([
                        'sewa' => 'Sewa',
                        'denda' => 'Denda',
                    ])
                    ->required(),

                Select::make('metode')
                    ->label('Metode Pembayaran')
                    ->options([
                        'tunai' => 'Tunai',
                        'transfer_bank' => 'Transfer Bank',
                        'qris' => 'QRIS',
                        'ewallet' => 'E-Wallet',
                    ])
                    ->required(),

                TextInput::make('jumlah')
                    ->label('Jumlah Pembayaran')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'berhasil' => 'Berhasil',
                        'gagal' => 'Gagal',
                        'refund' => 'Refund',
                    ])
                    ->default('menunggu')
                    ->required(),

                FileUpload::make('bukti_bayar')
                    ->label('Bukti Pembayaran')
                    ->image()
                    ->directory('bukti-pembayaran'),

                Textarea::make('catatan')
                    ->label('Catatan')
                    ->columnSpanFull(),

                DateTimePicker::make('dibayar_pada')
                    ->label('Tanggal Pembayaran')
                    ->required(),
            ]);
    }
}
