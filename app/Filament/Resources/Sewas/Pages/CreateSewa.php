<?php

namespace App\Filament\Resources\Sewas\Pages;

use App\Filament\Resources\Sewas\SewaResource;
use App\Models\Sewa;
use Filament\Resources\Pages\CreateRecord;

class CreateSewa extends CreateRecord
{
    protected static string $resource = SewaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $lastSewa = Sewa::orderByDesc('id')->first();

        $nextNumber = 1;

        if ($lastSewa && preg_match('/(\d+)$/', $lastSewa->kode_sewa, $matches)) {
            $nextNumber = ((int) $matches[1]) + 1;
        }

        while (
            Sewa::where(
                'kode_sewa',
                'SW-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT)
            )->exists()
        ) {
            $nextNumber++;
        }

        $data['kode_sewa'] = 'SW-' . str_pad(
            $nextNumber,
            4,
            '0',
            STR_PAD_LEFT
        );

        $data['total_harga'] = 0;
        $data['total_deposit'] = 0;
        $data['denda'] = 0;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl(
            'edit',
            ['record' => $this->record]
        );
    }
}
