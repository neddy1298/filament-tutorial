<?php

namespace App\Filament\Resources\MasterAnggaranResource\Pages;

use App\Filament\Resources\MasterAnggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMasterAnggaran extends ViewRecord
{
    protected static string $resource = MasterAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
