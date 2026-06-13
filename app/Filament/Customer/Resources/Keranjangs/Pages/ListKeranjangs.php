<?php

namespace App\Filament\Customer\Resources\Keranjangs\Pages;

use App\Filament\Customer\Resources\Keranjangs\KeranjangResource;
use Filament\Resources\Pages\ListRecords;

class ListKeranjangs extends ListRecords
{
    protected static string $resource = KeranjangResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
