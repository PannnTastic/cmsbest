<?php

namespace App\Filament\Resources\CartProducts\Pages;

use App\Filament\Resources\CartProducts\CartProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCartProducts extends ListRecords
{
    protected static string $resource = CartProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
