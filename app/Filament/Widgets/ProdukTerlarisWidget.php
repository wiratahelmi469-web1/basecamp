<?php

namespace App\Filament\Widgets;

use App\Models\Produk;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class ProdukTerlarisWidget extends TableWidget
{
    protected static ?string $heading = '🔥 Produk Terlaris';

    protected int|string|array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Produk::query()
                    ->withSum('detailPenyewaan', 'jumlah')
                    ->orderByDesc('detail_penyewaan_sum_jumlah')
                    ->limit(8)
            )
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Produk')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('stok_tersedia')
                    ->label('Stok')
                    ->badge()
                    ->color(fn($state) => $state <= 5 ? 'danger' : 'success'),

                Tables\Columns\TextColumn::make('detail_penyewaan_sum_jumlah')
                    ->label('Total Disewa')
                    ->badge()
                    ->color('warning')
                    ->formatStateUsing(fn($state) => ($state ?? 0) . ' x'),
            ])
            ->paginated(false);
    }
}
