<?php

namespace App\Filament\Resources\CartProducts;

use App\Filament\Resources\CartProducts\Pages\CreateCartProduct;
use App\Filament\Resources\CartProducts\Pages\EditCartProduct;
use App\Filament\Resources\CartProducts\Pages\ListCartProducts;
use App\Filament\Resources\CartProducts\Schemas\CartProductForm;
use App\Filament\Resources\CartProducts\Tables\CartProductsTable;
use App\Models\CartProduct;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CartProductResource extends Resource
{
    protected static ?string $model = CartProduct::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CurrencyDollar;

    protected static ?string $recordTitleAttribute = 'Order';
    protected static ?string $label = 'Order';
    protected static ?string $pluralLabel = 'Orders';
    

    public static function form(Schema $schema): Schema
    {
        return CartProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CartProductsTable::configure($table);
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
            'index' => ListCartProducts::route('/'),
            'create' => CreateCartProduct::route('/create'),
            'edit' => EditCartProduct::route('/{record}/edit'),
        ];
    }
}
