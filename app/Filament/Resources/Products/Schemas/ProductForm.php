<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'nama_kategori')
                    ->label('Kategori')
                    ->required(),
                TextInput::make('nama_produk')
                    ->label('Nama Produk')
                    ->required(),
                TextInput::make('harga')
                    ->label('Harga')
                    ->prefix('Rp')
                    ->required()
                    ->numeric(),
                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                TextInput::make('stok')
                    ->label('Stok')
                    ->required()
                    ->numeric()
                    ->default(0),
                Repeater::make('pictures')
                    ->relationship()
                    ->schema([
                        TextInput::make('nama_gambar')
                            ->label('Nama Gambar')
                            ->required(),
                        FileUpload::make('path_gambar')
                            ->label('Gambar')
                            ->directory('products')
                            ->disk('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                            ->imagePreviewHeight('100px')
                            ->imageResizeTargetWidth('1000')
                            ->imageResizeTargetHeight('1000')
                            ->imageResizeMode('cover')
                            ->required(),
                    ]),
                Toggle::make('is_active')
                    ->label('Status')
                    ->required(),
            ]);
    }
}
