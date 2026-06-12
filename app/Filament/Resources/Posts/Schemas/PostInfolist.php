<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                ImageEntry::make('thumbnail')
                    ->label('Thumbnail'),

                TextEntry::make('title')
                    ->label('Judul Artikel'),

                TextEntry::make('slug')
                    ->label('Slug'),

                TextEntry::make('user.nama')
                    ->label('Penulis'),

                TextEntry::make('status')
                    ->badge(),

                TextEntry::make('published_at')
                    ->label('Tanggal Publish')
                    ->dateTime('d M Y H:i'),

                TextEntry::make('excerpt')
                    ->label('Ringkasan')
                    ->columnSpanFull(),

                TextEntry::make('content')
                    ->label('Isi Artikel')
                    ->html()
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),

                TextEntry::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d M Y H:i'),
            ]);
    }
}
