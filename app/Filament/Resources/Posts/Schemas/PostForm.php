<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('title')
                    ->label('Judul Artikel')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (
                        ?string $state,
                        Set $set
                    ) {
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Textarea::make('excerpt')
                    ->label('Ringkasan Artikel')
                    ->rows(3)
                    ->maxLength(300),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->directory('blog'),

                RichEditor::make('content')
                    ->label('Konten Artikel')
                    ->required()
                    ->columnSpanFull(),

                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required(),

                DateTimePicker::make('published_at')
                    ->label('Tanggal Publish'),

                Select::make('user_id')
                    ->label('Penulis')
                    ->relationship('user', 'nama')
                    ->searchable()
                    ->preload(),
            ]);
    }
}
