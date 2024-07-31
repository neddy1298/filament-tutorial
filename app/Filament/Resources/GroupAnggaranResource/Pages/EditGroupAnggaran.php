<?php

namespace App\Filament\Resources\GroupAnggaranResource\Pages;

use App\Filament\Resources\GroupAnggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGroupAnggaran extends EditRecord
{
    protected static string $resource = GroupAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
