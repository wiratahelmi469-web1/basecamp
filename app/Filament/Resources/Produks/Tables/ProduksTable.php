<?php

namespace App\Filament\Resources\Produks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular(),

                TextColumn::make('kode_produk')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kategori.nama')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('merek')
                    ->label('Merek')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('stok_total')
                    ->label('Stok Total')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('stok_tersedia')
                    ->label('Stok Tersedia')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('harga_sewa_per_hari')
                    ->label('Harga/Hari')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('deposit')
                    ->label('Deposit')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('kondisi')
                    ->badge()
                    ->colors([
                        'success' => 'baik',
                        'warning' => 'rusak_ringan',
                        'danger' => 'rusak_berat',
                        'gray' => 'tidak_aktif',
                    ]),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d M Y')
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
