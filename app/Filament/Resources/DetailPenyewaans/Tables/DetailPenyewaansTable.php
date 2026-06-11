<?php

namespace App\Filament\Resources\DetailPenyewaans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DetailPenyewaansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('sewa.kode_sewa')
                    ->label('Kode Sewa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('produk.nama')
                    ->label('Produk')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('harga_per_hari')
                    ->label('Harga/Hari')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('deposit')
                    ->label('Deposit')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('jumlah_hari')
                    ->label('Hari')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('kondisi_awal')
                    ->label('Kondisi Awal')
                    ->badge()
                    ->colors([
                        'success' => 'baik',
                        'warning' => 'rusak_ringan',
                        'danger' => 'rusak_berat',
                    ]),

                TextColumn::make('kondisi_akhir')
                    ->label('Kondisi Akhir')
                    ->badge()
                    ->colors([
                        'success' => 'baik',
                        'warning' => 'rusak_ringan',
                        'danger' => 'rusak_berat',
                    ]),
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
