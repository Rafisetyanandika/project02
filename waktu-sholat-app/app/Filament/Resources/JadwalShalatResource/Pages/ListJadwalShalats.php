<?php

namespace App\Filament\Resources\JadwalShalatResource\Pages;

use App\Filament\Resources\JadwalShalatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJadwalShalats extends ListRecords
{
    protected static string $resource = JadwalShalatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
