<?php

namespace App\Filament\Resources\DetailPenyewaans\Pages;

use App\Filament\Resources\DetailPenyewaans\DetailPenyewaanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDetailPenyewaans extends ListRecords
{
    protected static string $resource = DetailPenyewaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
