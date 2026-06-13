<?php

namespace App\Filament\Customer\Resources\PembayaranSayas\Pages;

use App\Filament\Customer\Resources\PembayaranSayas\PembayaranSayaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPembayaranSaya extends EditRecord
{
    protected static string $resource = PembayaranSayaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
