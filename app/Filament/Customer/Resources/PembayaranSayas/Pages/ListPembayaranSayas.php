<?php

namespace App\Filament\Customer\Resources\PembayaranSayas\Pages;

use App\Filament\Customer\Resources\PembayaranSayas\PembayaranSayaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPembayaranSayas extends ListRecords
{
    protected static string $resource = PembayaranSayaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
