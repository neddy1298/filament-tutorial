<?php

namespace App\Filament\Resources\GroupAnggaranResource\Pages;

use App\Filament\Resources\GroupAnggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGroupAnggaran extends ViewRecord
{
    protected static string $resource = GroupAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
