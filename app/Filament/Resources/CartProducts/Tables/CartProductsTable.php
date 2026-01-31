<?php

namespace App\Filament\Resources\CartProducts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CartProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cart_id')
                    ->label('Cart (User - Qty)')
                    ->formatStateUsing(function ($record) {
                        return $record->cart->user->nama_lengkap . ' - ' . $record->cart->jumlah_order . ' Order';
                    })
                    ->sortable(),
                TextColumn::make('product.nama_produk')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jumlah_produk')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
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
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
