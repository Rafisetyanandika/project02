<?php

namespace App\Filament\Resources\AdzanResource\Pages;

use App\Filament\Resources\AdzanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdzan extends EditRecord
{
    protected static string $resource = AdzanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
