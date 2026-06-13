<?php

namespace App\Filament\Customer\Resources\PembayaranSayas\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PembayaranSayaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informasi Pembayaran')
                    ->schema([

                        TextEntry::make('kode_pembayaran')
                            ->label('Kode Pembayaran'),

                        TextEntry::make('sewa.kode_sewa')
                            ->label('Kode Sewa'),

                        TextEntry::make('jenis')
                            ->badge(),

                        TextEntry::make('metode')
                            ->badge(),

                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'menunggu' => 'warning',
                                'berhasil' => 'success',
                                'gagal' => 'danger',
                                'refund' => 'gray',
                                default => 'gray',
                            }),

                    ])
                    ->columns(2),

                Section::make('Nominal')
                    ->schema([

                        TextEntry::make('jumlah')
                            ->label('Jumlah Pembayaran')
                            ->money('IDR'),

                    ]),

                Section::make('Bukti Pembayaran')
                    ->schema([

                        ImageEntry::make('bukti_bayar')
                            ->label('Bukti Transfer'),

                    ]),

                Section::make('Informasi Tambahan')
                    ->schema([

                        TextEntry::make('catatan')
                            ->placeholder('Tidak ada catatan'),

                        TextEntry::make('dibayar_pada')
                            ->label('Tanggal Pembayaran')
                            ->dateTime('d M Y H:i'),

                    ]),

            ]);
    }
}

