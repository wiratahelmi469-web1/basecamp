<?php

namespace App\Filament\Resources\DetailPenyewaans\Pages;

use App\Filament\Resources\DetailPenyewaans\DetailPenyewaanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDetailPenyewaan extends EditRecord
{
    protected static string $resource = DetailPenyewaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
