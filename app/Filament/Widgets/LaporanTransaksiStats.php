<?php

namespace App\Filament\Widgets;

use App\Models\Pembayaran;
use App\Models\Sewa;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LaporanTransaksiStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalTransaksi = Sewa::count();

        $totalPendapatan = Pembayaran::where(
            'status',
            'berhasil'
        )->sum('jumlah');

        $totalDenda = Sewa::sum('denda');

        $penyewaanAktif = Sewa::whereIn('status', [
            'dikonfirmasi',
            'disewa',
        ])->count();

        $penyewaanSelesai = Sewa::where('status', 'selesai')
            ->count();

        return [

            Stat::make(
                'Total Transaksi',
                number_format($totalTransaksi)
            )
                ->description('Seluruh transaksi penyewaan')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make(
                'Total Pendapatan',
                'Rp ' . number_format($totalPendapatan, 0, ',', '.')
            )
                ->description('Pembayaran berhasil')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make(
                'Total Denda',
                'Rp ' . number_format($totalDenda, 0, ',', '.')
            )
                ->description('Akumulasi denda')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),

            Stat::make(
                'Penyewaan Aktif',
                number_format($penyewaanAktif)
            )
                ->description('Sedang berjalan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make(
                'Penyewaan Selesai',
                number_format($penyewaanSelesai)
            )
                ->description('Transaksi selesai')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
