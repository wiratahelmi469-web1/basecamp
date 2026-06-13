<?php

namespace App\Filament\Customer\Resources\PembayaranSayas\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Table;

class PembayaranSayasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')

            ->columns([

                Tables\Columns\TextColumn::make('kode_pembayaran')
                    ->label('Kode Pembayaran')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sewa.kode_sewa')
                    ->label('Kode Sewa')
                    ->searchable(),

                Tables\Columns\TextColumn::make('metode')
                    ->badge(),

                Tables\Columns\TextColumn::make('jumlah')
                    ->money('IDR')
                    ->label('Jumlah'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'menunggu' => 'warning',
                        'berhasil' => 'success',
                        'gagal' => 'danger',
                        'refund' => 'gray',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('dibayar_pada')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i'),

            ])

            ->filters([])

            ->recordActions([
                ViewAction::make(),
            ])

            ->toolbarActions([]);
    }
}
