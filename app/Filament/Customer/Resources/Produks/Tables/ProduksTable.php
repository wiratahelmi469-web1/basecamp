<?php

namespace App\Filament\Customer\Resources\Produks\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')

            ->columns([

                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->square(),

                TextColumn::make('nama')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kategori.nama')
                    ->label('Kategori')
                    ->badge(),

                TextColumn::make('merek')
                    ->label('Merek'),

                TextColumn::make('stok_tersedia')
                    ->label('Stok')
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger'),

                TextColumn::make('harga_sewa_per_hari')
                    ->label('Harga / Hari')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('kondisi')
                    ->badge(),

            ])

            ->filters([])

            ->recordActions([
                ViewAction::make()
                    ->label('Detail'),
            ])

            ->toolbarActions([]);
    }
}
