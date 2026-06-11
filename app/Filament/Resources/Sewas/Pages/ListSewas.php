<?php

namespace App\Filament\Resources\Sewas\Pages;

use App\Filament\Resources\Sewas\SewaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSewas extends ListRecords
{
    protected static string $resource = SewaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
