<?php

namespace App\Filament\Resources\KendaraanResource\Pages;

use App\Filament\Resources\KendaraanResource;
use App\Models\Maintenance;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKendaraan extends CreateRecord
{
    protected static string $resource = KendaraanResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;

        // Create maintenance if created
        Maintenance::create([
            'kendaraan_id' => $record->id,
            // Add other necessary fields here
        ]);
    }
}
