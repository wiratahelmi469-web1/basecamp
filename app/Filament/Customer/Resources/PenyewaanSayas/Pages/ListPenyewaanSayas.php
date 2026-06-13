<?php

namespace App\Filament\Customer\Resources\PenyewaanSayas\Pages;

use App\Filament\Customer\Resources\PenyewaanSayas\PenyewaanSayaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPenyewaanSayas extends ListRecords
{
    protected static string $resource = PenyewaanSayaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
