<?php

namespace App\Filament\Customer\Resources\PenyewaanSayas\Pages;

use App\Filament\Customer\Resources\PenyewaanSayas\PenyewaanSayaResource;
use Filament\Resources\Pages\ViewRecord;

class ViewPenyewaanSaya extends ViewRecord
{
    protected static string $resource = PenyewaanSayaResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTitle(): string
    {
        return 'Detail Penyewaan';
    }

    public function getHeading(): string
    {
        return 'Detail Penyewaan';
    }

    public function getSubheading(): ?string
    {
        return $this->record->kode_sewa;
    }
}
