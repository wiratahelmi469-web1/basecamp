<?php

namespace App\Filament\Resources\Sewas\Pages;

use App\Filament\Resources\Sewas\SewaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSewa extends EditRecord
{
    protected static string $resource = SewaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
