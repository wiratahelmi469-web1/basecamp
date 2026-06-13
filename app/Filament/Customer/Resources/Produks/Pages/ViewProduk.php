<?php

namespace App\Filament\Customer\Resources\Produks\Pages;

use App\Filament\Customer\Resources\Produks\ProdukResource;
use App\Models\Keranjang;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewProduk extends ViewRecord
{
    protected static string $resource = ProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('tambahKeranjang')
                ->label('Tambah ke Keranjang')
                ->icon('heroicon-o-shopping-cart')
                ->color('success')

                ->action(function () {

                    $item = Keranjang::firstOrCreate(
                        [
                            'user_id' => auth()->id(),
                            'produk_id' => $this->record->id,
                        ],
                        [
                            'jumlah' => 1,
                        ]
                    );

                    if (! $item->wasRecentlyCreated) {

                        $item->increment('jumlah');
                    }

                    Notification::make()
                        ->title('Produk berhasil ditambahkan ke keranjang')
                        ->success()
                        ->send();
                }),

        ];
    }

    public function getTitle(): string
    {
        return 'Detail Produk';
    }

    public function getHeading(): string
    {
        return $this->record->nama;
    }

    public function getSubheading(): ?string
    {
        return $this->record->kategori?->nama;
    }
}
