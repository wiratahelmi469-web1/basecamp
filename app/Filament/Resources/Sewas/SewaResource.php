<?php

namespace App\Filament\Resources\Sewas;

use App\Filament\Resources\Sewas\Pages\CreateSewa;
use App\Filament\Resources\Sewas\Pages\EditSewa;
use App\Filament\Resources\Sewas\Pages\ListSewas;
use App\Filament\Resources\Sewas\Schemas\SewaForm;
use App\Filament\Resources\Sewas\Tables\SewasTable;
use App\Models\Sewa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SewaResource extends Resource
{
    protected static ?string $model = Sewa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'kode_sewa';

    public static function form(Schema $schema): Schema
    {
        return SewaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SewasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DetailPenyewaanRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSewas::route('/'),
            'create' => CreateSewa::route('/create'),
            'edit' => EditSewa::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'user',
                'admin',
                'detailPenyewaan.produk',
            ]);
    }
}
