<?php

namespace App\Filament\Customer\Resources\Produks;

use App\Filament\Customer\Resources\Produks\Pages\ListProduks;
use App\Filament\Customer\Resources\Produks\Pages\ViewProduk;
use App\Filament\Customer\Resources\Produks\Schemas\ProdukForm;
use App\Filament\Customer\Resources\Produks\Schemas\ProdukInfolist;
use App\Filament\Customer\Resources\Produks\Tables\ProduksTable;
use App\Models\Produk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static ?string $navigationLabel = 'Katalog Produk';

    protected static ?string $modelLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Katalog Produk';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ProdukForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProdukInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProduksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProduks::route('/'),
            'view' => ViewProduk::route('/{record}'),
        ];
    }
}
