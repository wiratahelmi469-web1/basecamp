<?php

namespace App\Filament\Widgets;

use App\Models\Kategori;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Sewa;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalPendapatan = Pembayaran::where('status', 'berhasil')
            ->sum('jumlah');

        $stokMenipis = Produk::where('stok_tersedia', '<=', 3)
            ->count();

        $sewaAktif = Sewa::whereIn('status', [
            'dikonfirmasi',
            'disewa',
        ])->count();

        return [

            Stat::make('Total Produk', Produk::count())
                ->description('Produk terdaftar')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success'),

            Stat::make('Total Kategori', Kategori::count())
                ->description('Kategori produk')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('info'),

            Stat::make('Total Penyewaan', Sewa::count())
                ->description('Seluruh transaksi')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),

            Stat::make(
                'Total Pendapatan',
                'Rp '.number_format($totalPendapatan, 0, ',', '.')
            )
                ->description('Pembayaran berhasil')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Penyewaan Aktif', $sewaAktif)
                ->description('Sedang berjalan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('primary'),

            Stat::make('Stok Menipis', $stokMenipis)
                ->description('Stok ≤ 3')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
