<?php

namespace App\Filament\Resources\JadwalShalatResource\Pages;

use App\Filament\Resources\JadwalShalatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJadwalShalat extends EditRecord
{
    protected static string $resource = JadwalShalatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
