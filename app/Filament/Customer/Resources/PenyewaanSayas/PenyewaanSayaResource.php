<?php

namespace App\Filament\Customer\Resources\PenyewaanSayas;

use App\Filament\Customer\Resources\PenyewaanSayas\Pages\ListPenyewaanSayas;
use App\Filament\Customer\Resources\PenyewaanSayas\Pages\ViewPenyewaanSaya;
use App\Models\Sewa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class PenyewaanSayaResource extends Resource
{
    protected static ?string $model = Sewa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Penyewaan Saya';

    protected static ?string $modelLabel = 'Penyewaan';

    protected static ?string $pluralModelLabel = 'Penyewaan Saya';

    protected static ?string $recordTitleAttribute = 'kode_sewa';

    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')

            ->columns([

                TextColumn::make('kode_sewa')
                    ->label('Kode Sewa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tanggal_sewa')
                    ->label('Tanggal Sewa')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tanggal_kembali')
                    ->label('Tanggal Kembali')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'menunggu' => 'warning',
                        'dikonfirmasi' => 'info',
                        'disewa' => 'primary',
                        'dikembalikan' => 'success',
                        'selesai' => 'success',
                        'dibatalkan' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('total_harga')
                    ->label('Total Biaya')
                    ->money('IDR', divideBy: 1)
                    ->sortable(),

                TextColumn::make('total_deposit')
                    ->label('Deposit')
                    ->money('IDR', divideBy: 1)
                    ->toggleable(),

                TextColumn::make('denda')
                    ->label('Denda')
                    ->money('IDR', divideBy: 1)
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),

            ])

            ->filters([])

            ->recordActions([])

            ->toolbarActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPenyewaanSayas::route('/'),

        ];
    }
}

