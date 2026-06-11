<?php

namespace App\Filament\Resources\Pembayarans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PembayaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('sewa.kode_sewa')
                    ->label('Kode Sewa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kode_pembayaran')
                    ->label('Kode Pembayaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->colors([
                        'success' => 'sewa',
                        'warning' => 'denda',
                    ]),

                TextColumn::make('metode')
                    ->label('Metode')
                    ->badge(),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'menunggu',
                        'success' => 'berhasil',
                        'danger' => 'gagal',
                        'gray' => 'refund',
                    ]),

                ImageColumn::make('bukti_bayar')
                    ->label('Bukti Bayar')
                    ->square(),

                TextColumn::make('dibayar_pada')
                    ->label('Dibayar Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
