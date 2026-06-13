<?php

namespace App\Filament\Customer\Resources\PembayaranSayas;

use App\Filament\Customer\Resources\PembayaranSayas\Pages\ListPembayaranSayas;
use App\Filament\Customer\Resources\PembayaranSayas\Pages\ViewPembayaranSaya;
use App\Filament\Customer\Resources\PembayaranSayas\Schemas\PembayaranSayaInfolist;
use App\Filament\Customer\Resources\PembayaranSayas\Tables\PembayaranSayasTable;
use App\Models\Pembayaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PembayaranSayaResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCreditCard;

    protected static ?string $navigationLabel = 'Pembayaran Saya';

    protected static ?string $modelLabel = 'Pembayaran';

    protected static ?string $pluralModelLabel = 'Pembayaran Saya';

    protected static ?string $recordTitleAttribute = 'kode_pembayaran';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('sewa', function ($query) {
                $query->where('user_id', auth()->id());
            });
    }

    public static function infolist(Schema $schema): Schema
    {
        return PembayaranSayaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PembayaranSayasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPembayaranSayas::route('/'),
            'view' => ViewPembayaranSaya::route('/{record}'),
        ];
    }
}
