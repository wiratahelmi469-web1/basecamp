<?php

namespace App\Filament\Resources\LaporanTransaksis;

use App\Filament\Resources\LaporanTransaksis\Pages\ManageLaporanTransaksis;
use App\Models\Sewa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class LaporanTransaksiResource extends Resource
{
    protected static ?string $model = Sewa::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Laporan Transaksi';

    protected static string|UnitEnum|null $navigationGroup = 'Laporan';

    protected static ?string $recordTitleAttribute = 'kode_sewa';

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')

            ->columns([

                TextColumn::make('kode_sewa')
                    ->label('Kode Sewa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.nama')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tanggal_sewa')
                    ->label('Tanggal Sewa')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tanggal_kembali')
                    ->label('Tanggal Kembali')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('barang_disewa')
                    ->label('Barang Disewa')
                    ->getStateUsing(function (Sewa $record) {

                        return $record->detailPenyewaan
                            ->map(function ($detail) {

                                return $detail->produk->nama.
                                    ' ('.$detail->jumlah.')';

                            })
                            ->implode(', ');
                    })
                    ->wrap(),

                TextColumn::make('total_harga')
                    ->label('Total Sewa')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('total_deposit')
                    ->label('Deposit')
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

            ->recordActions([])

            ->toolbarActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageLaporanTransaksis::route('/'),
        ];
    }
}
