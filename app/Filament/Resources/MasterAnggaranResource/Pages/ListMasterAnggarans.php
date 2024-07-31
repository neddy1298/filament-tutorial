<?php

namespace App\Filament\Resources\MasterAnggaranResource\Pages;

use App\Filament\Resources\MasterAnggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterAnggarans extends ListRecords
{
    protected static string $resource = MasterAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
