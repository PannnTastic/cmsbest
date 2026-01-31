<?php

namespace App\Filament\Resources\CartProducts\Pages;

use App\Filament\Resources\CartProducts\CartProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCartProduct extends CreateRecord
{
    protected static string $resource = CartProductResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
