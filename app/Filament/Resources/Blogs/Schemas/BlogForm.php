<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul_blog')
                    ->label('Judul Blog')
                    ->required(),
                FileUpload::make('pdf_blog')
                    ->label('PDF Blog')
                    ->directory('blogs')
                    ->acceptedFileTypes(['application/pdf'])
                    ->openable()
                    ->downloadable()
                    ->disk('public')
                    ->required(),
                FileUpload::make('gambar_blog')
                    ->label('Gambar Blog')
                    ->directory('blogs')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                    ->imagePreviewHeight('100px')
                    ->imageResizeTargetWidth('1000')
                    ->imageResizeTargetHeight('1000')
                    ->imageResizeMode('cover')
                    ->disk('public')
                    ->required(),
            ]);
    }
}
