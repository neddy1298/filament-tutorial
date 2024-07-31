<?php

namespace App\Filament\Resources\MasterAnggaranResource\Pages;

use App\Filament\Resources\MasterAnggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterAnggaran extends EditRecord
{
    protected static string $resource = MasterAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
