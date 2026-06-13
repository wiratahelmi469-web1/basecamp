<?php

namespace App\Filament\Customer\Resources\Keranjangs\Tables;

use Carbon\Carbon;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Table;

class KeranjangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('produk.nama')
                    ->label('Produk')
                    ->searchable(),

                Tables\Columns\TextColumn::make('jumlah')
                    ->badge(),

                Tables\Columns\TextColumn::make('tanggal_sewa')
                    ->date('d M Y'),

                Tables\Columns\TextColumn::make('tanggal_kembali')
                    ->date('d M Y'),

                Tables\Columns\TextColumn::make('produk.harga_sewa_per_hari')
                    ->label('Harga / Hari')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Estimasi Total')
                    ->state(function ($record) {

                        if (
                            ! $record->tanggal_sewa ||
                            ! $record->tanggal_kembali
                        ) {
                            return 0;
                        }

                        $hari = Carbon::parse($record->tanggal_sewa)
                            ->diffInDays(
                                Carbon::parse($record->tanggal_kembali)
                            ) + 1;

                        return
                            $record->jumlah *
                            $record->produk->harga_sewa_per_hari *
                            $hari;
                    })
                    ->money('IDR'),

            ])

            ->recordActions([

                EditAction::make()
                    ->form([

                        TextInput::make('jumlah')
                            ->numeric()
                            ->required()
                            ->minValue(1),

                        DatePicker::make('tanggal_sewa')
                            ->required(),

                        DatePicker::make('tanggal_kembali')
                            ->required(),

                    ]),

                DeleteAction::make(),

            ])

            ->toolbarActions([]);
    }
}
