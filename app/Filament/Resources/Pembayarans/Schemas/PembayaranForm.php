<?php

namespace App\Filament\Resources\Pembayarans\Schemas;

use App\Models\Sewa;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
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
                    ->live()
                    ->afterStateUpdated(function (
                        Get $get,
                        Set $set,
                        $state
                    ) {

                        $sewa = Sewa::find($state);

                        if (! $sewa) {
                            return;
                        }

                        if ($get('jenis') === 'sewa') {

                            $set(
                                'jumlah',
                                $sewa->total_harga + $sewa->total_deposit
                            );
                        }

                        if ($get('jenis') === 'denda') {

                            $set(
                                'jumlah',
                                $sewa->denda
                            );
                        }
                    })
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
                    ->live()
                    ->afterStateUpdated(function (
                        Get $get,
                        Set $set,
                        $state
                    ) {

                        $sewa = Sewa::find(
                            $get('sewa_id')
                        );

                        if (! $sewa) {
                            return;
                        }

                        if ($state === 'sewa') {

                            $set(
                                'jumlah',
                                $sewa->total_harga + $sewa->total_deposit
                            );
                        }

                        if ($state === 'denda') {

                            $set(
                                'jumlah',
                                $sewa->denda
                            );
                        }
                    })
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
                    ->readOnly()
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
                    ->default(now())
                    ->required(),
            ]);
    }
}
