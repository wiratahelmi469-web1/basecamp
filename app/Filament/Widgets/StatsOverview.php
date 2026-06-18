<?php

namespace App\Filament\Widgets;

use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Sewa;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected int|string|array $columnSpan = 'full';

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

        $totalCustomer = User::where('role', 'customer')
            ->count();

        return [

            Stat::make('Total Produk', Produk::count())
                ->description('Produk tersedia')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success'),

            Stat::make('Total Customer', $totalCustomer)
                ->description('Pelanggan terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Total Penyewaan', Sewa::count())
                ->description('Seluruh transaksi')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),

            Stat::make(
                'Pendapatan',
                'Rp ' . number_format($totalPendapatan, 0, ',', '.')
            )
                ->description('Pembayaran berhasil')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Penyewaan Aktif', $sewaAktif)
                ->description('Sedang berlangsung')
                ->descriptionIcon('heroicon-m-clock')
                ->color('primary'),

            Stat::make('Stok Menipis', $stokMenipis)
                ->description('Perlu restock')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
