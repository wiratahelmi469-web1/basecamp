<?php

namespace App\Filament\Customer\Resources\Keranjangs\Pages;

use App\Filament\Customer\Resources\Keranjangs\KeranjangResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditKeranjang extends EditRecord
{
    protected static string $resource = KeranjangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
