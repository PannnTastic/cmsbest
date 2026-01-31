<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.nama_kategori')
                    ->alignCenter()
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_produk')
                    ->alignCenter()
                    ->label('Nama Produk')
                    ->searchable(),
                ImageColumn::make('pictures.path_gambar')
                    ->alignCenter()
                    ->circular()
                    ->stacked()
                    ->ring(4)
                    ->limit(3)
                    ->extraImgAttributes(['class' => '-ml-16 first:ml-0'])
                    ->label('Gambar')
                    ->disk('public')
                    ->width('100px')
                    ->height('100px')
                    ->searchable(),
                TextColumn::make('harga')
                    ->alignCenter()
                    ->prefix('Rp ')
                    ->label('Harga')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stok')
                    ->alignCenter()
                    ->label('Stok')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->alignCenter()
                    ->label('Status')
                    ->boolean(),
                TextColumn::make('deskripsi')
                    ->alignCenter()
                    ->label('Deskripsi'),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                DeleteAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
