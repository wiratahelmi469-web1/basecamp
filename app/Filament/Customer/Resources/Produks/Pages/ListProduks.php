<?php

namespace App\Filament\Customer\Resources\Produks\Pages;

use App\Filament\Customer\Resources\Produks\ProdukResource;
use Filament\Resources\Pages\ListRecords;

class ListProduks extends ListRecords
{
    protected static string $resource = ProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
