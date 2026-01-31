<?php

namespace App\Filament\Resources\CartProducts\Pages;

use App\Filament\Resources\CartProducts\CartProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCartProduct extends EditRecord
{
    protected static string $resource = CartProductResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
