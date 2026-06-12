<?php

namespace App\Filament\Resources\LaporanTransaksis\Pages;

use App\Filament\Resources\LaporanTransaksis\LaporanTransaksiResource;
use App\Filament\Widgets\LaporanTransaksiStats;
use Filament\Resources\Pages\ManageRecords;

class ManageLaporanTransaksis extends ManageRecords
{
    protected static string $resource = LaporanTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LaporanTransaksiStats::class,
        ];
    }

    public function getTitle(): string
    {
        return 'Laporan Transaksi';
    }

    public function getHeading(): string
    {
        return 'Laporan Transaksi Penyewaan';
    }

    public function getSubheading(): ?string
    {
        return 'Rekap seluruh transaksi penyewaan outdoor';
    }
}
