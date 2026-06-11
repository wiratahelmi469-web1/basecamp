<?php

namespace App\Filament\Resources\Sewas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SewasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('kode_sewa')
                    ->label('Kode Sewa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.nama')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('admin.nama')
                    ->label('Admin')
                    ->toggleable(),

                TextColumn::make('tanggal_sewa')
                    ->label('Tanggal Sewa')
                    ->date()
                    ->sortable(),

                TextColumn::make('tanggal_kembali')
                    ->label('Tanggal Kembali')
                    ->date()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'menunggu',
                        'info' => 'dikonfirmasi',
                        'success' => 'disewa',
                        'gray' => 'dikembalikan',
                        'primary' => 'selesai',
                        'danger' => 'dibatalkan',
                    ]),

                TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('total_deposit')
                    ->label('Total Deposit')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('denda')
                    ->label('Denda')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
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
