<?php

namespace App\Filament\Customer\Resources\PembayaranSayas\Pages;

use App\Filament\Customer\Resources\PembayaranSayas\PembayaranSayaResource;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewPembayaranSaya extends ViewRecord
{
    protected static string $resource = PembayaranSayaResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('uploadBukti')
                ->label('Upload Bukti Bayar')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success')

                ->visible(fn () =>
                    $this->record->status === 'menunggu'
                )

                ->form([

                    FileUpload::make('bukti_bayar')
                        ->label('Bukti Transfer')
                        ->image()
                        ->directory('bukti-pembayaran')
                        ->required(),

                ])

                ->action(function (array $data) {

                    $this->record->update([
                        'bukti_bayar' => $data['bukti_bayar'],
                    ]);

                    Notification::make()
                        ->title('Bukti pembayaran berhasil diupload')
                        ->success()
                        ->send();
                }),

        ];
    }

    public function getTitle(): string
    {
        return 'Detail Pembayaran';
    }

    public function getHeading(): string
    {
        return 'Detail Pembayaran';
    }

    public function getSubheading(): ?string
    {
        return $this->record->kode_pembayaran;
    }
}

