<?php

namespace App\Filament\Customer\Resources\Keranjangs;

use App\Filament\Customer\Resources\Keranjangs\Pages\ListKeranjangs;
use App\Filament\Customer\Resources\Keranjangs\Tables\KeranjangsTable;
use App\Models\Keranjang;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KeranjangResource extends Resource
{
    protected static ?string $model = Keranjang::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static ?string $navigationLabel = 'Keranjang Saya';

    protected static ?string $modelLabel = 'Keranjang';

    protected static ?string $pluralModelLabel = 'Keranjang Saya';

    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
    }

    public static function table(Table $table): Table
    {
        return KeranjangsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKeranjangs::route('/'),
        ];
    }
}
