<?php

namespace App\Filament\Customer\Widgets;

use App\Models\Sewa;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CustomerStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $user = Filament::auth()->user();

        $totalPenyewaan = Sewa::where('user_id', $user->id)
            ->count();

        $penyewaanAktif = Sewa::where('user_id', $user->id)
            ->whereIn('status', [
                'dikonfirmasi',
                'disewa',
            ])
            ->count();

        $penyewaanSelesai = Sewa::where('user_id', $user->id)
            ->where('status', 'selesai')
            ->count();

        $totalPengeluaran = Sewa::where('user_id', $user->id)
            ->whereIn('status', [
                'selesai',
                'dikembalikan',
            ])
            ->sum('total_harga');

        return [

            Stat::make(
                'Total Penyewaan',
                $totalPenyewaan
            )
                ->description('Seluruh transaksi saya')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make(
                'Penyewaan Aktif',
                $penyewaanAktif
            )
                ->description('Sedang berjalan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make(
                'Penyewaan Selesai',
                $penyewaanSelesai
            )
                ->description('Transaksi selesai')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make(
                'Total Pengeluaran',
                'Rp ' . number_format(
                    $totalPengeluaran,
                    0,
                    ',',
                    '.'
                )
            )
                ->description('Total biaya penyewaan')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info'),
        ];
    }
}
