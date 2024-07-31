<?php

namespace App\Filament\Resources\GroupAnggaranResource\Pages;

use App\Filament\Resources\GroupAnggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGroupAnggarans extends ListRecords
{
    protected static string $resource = GroupAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
