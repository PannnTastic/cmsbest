<?php

namespace App\Filament\Resources\CartProducts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Cart;
use App\Models\Product;

class CartProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('cart_id')
                    ->label('Cart (User - Qty)')
                    ->required()
                    ->options(Cart::with('user')->get()->mapWithKeys(function ($cart) {
                        return [$cart->cart_id => $cart->user->nama_lengkap . ' - ' . $cart->jumlah_order . ' Order'];
                    })),
                Select::make('product_id')
                    ->label('Product Name')
                    ->required()
                    ->options(Product::all()->pluck('nama_produk', 'product_id')),
                TextInput::make('jumlah_produk')
                    ->required()
                    ->numeric(),
            ]);
    }
}
