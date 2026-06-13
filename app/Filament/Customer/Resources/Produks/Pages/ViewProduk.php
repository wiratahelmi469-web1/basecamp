<?php

namespace App\Filament\Customer\Resources\Produks\Pages;

use App\Filament\Customer\Resources\Produks\ProdukResource;
use App\Models\Keranjang;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

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

                ->form([

                    TextInput::make('jumlah')
                        ->label('Jumlah')
                        ->numeric()
                        ->default(1)
                        ->minValue(1)
                        ->required(),

                    DatePicker::make('tanggal_sewa')
                        ->label('Tanggal Sewa')
                        ->minDate(now())
                        ->required(),

                    DatePicker::make('tanggal_kembali')
                        ->required()
                        ->after('tanggal_sewa')

                ])

                ->action(function (array $data) {

                    $item = Keranjang::updateOrCreate(
                        [
                            'user_id' => auth()->id(),
                            'produk_id' => $this->record->id,
                        ],
                        [
                            'jumlah' => $data['jumlah'],
                            'tanggal_sewa' => $data['tanggal_sewa'],
                            'tanggal_kembali' => $data['tanggal_kembali'],
                        ]
                    );

                    Notification::make()
                        ->title('Produk berhasil ditambahkan ke keranjang')
                        ->success()
                        ->send();
                })
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
