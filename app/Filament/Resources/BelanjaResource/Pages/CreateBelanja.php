<?php

namespace App\Filament\Resources\BelanjaResource\Pages;

use App\Filament\Resources\BelanjaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Maintenance;

class CreateBelanja extends CreateRecord
{
    protected static string $resource = BelanjaResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;

        // Update maintenances here
        $maintenance = Maintenance::find($record->maintenance_id);
        $maintenance
            ->update([
                'belanja_bahan_bakar_minyak' => $maintenance->belanja_bahan_bakar_minyak + $record->belanja_bahan_bakar_minyak,
                'belanja_pelumas_mesin' => $maintenance->belanja_pelumas_mesin + $record->belanja_pelumas_mesin,
                'belanja_suku_cadang' => $maintenance->belanja_suku_cadang + $record->belanja_suku_cadang,
            ])->save();
    }
}
