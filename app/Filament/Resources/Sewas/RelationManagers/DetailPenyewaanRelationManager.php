<?php

namespace App\Filament\Resources\Sewas\RelationManagers;

use App\Filament\Resources\DetailPenyewaans\DetailPenyewaanResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DetailPenyewaanRelationManager extends RelationManager
{
    protected static string $relationship = 'detailPenyewaan';

    protected static ?string $relatedResource = DetailPenyewaanResource::class;

    protected static ?string $title = 'Detail Barang Disewa';

    public function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('produk.nama')
                    ->label('Produk')
                    ->searchable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah'),

                TextColumn::make('jumlah_hari')
                    ->label('Hari'),

                TextColumn::make('harga_per_hari')
                    ->label('Harga/Hari')
                    ->money('IDR'),

                TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('IDR'),

                TextColumn::make('kondisi_awal')
                    ->label('Kondisi Awal')
                    ->badge(),

                TextColumn::make('kondisi_akhir')
                    ->label('Kondisi Akhir')
                    ->badge(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
