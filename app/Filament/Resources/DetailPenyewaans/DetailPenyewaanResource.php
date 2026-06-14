<?php

namespace App\Filament\Resources\DetailPenyewaans;

use App\Filament\Resources\DetailPenyewaans\Pages\CreateDetailPenyewaan;
use App\Filament\Resources\DetailPenyewaans\Pages\EditDetailPenyewaan;
use App\Filament\Resources\DetailPenyewaans\Pages\ListDetailPenyewaans;
use App\Filament\Resources\DetailPenyewaans\Schemas\DetailPenyewaanForm;
use App\Filament\Resources\DetailPenyewaans\Tables\DetailPenyewaansTable;
use App\Models\DetailPenyewaan;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class DetailPenyewaanResource extends Resource
{
    protected static ?string $model = DetailPenyewaan::class;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return DetailPenyewaanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DetailPenyewaansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDetailPenyewaans::route('/'),
            'create' => CreateDetailPenyewaan::route('/create'),
            'edit' => EditDetailPenyewaan::route('/{record}/edit'),
        ];
    }
}
