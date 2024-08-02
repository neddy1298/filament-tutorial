<?php

namespace App\Filament\Resources\KendaraanResource\Pages;

use App\Filament\Resources\KendaraanResource;
use App\Models\Kendaraan;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListKendaraans extends ListRecords
{
    protected static string $resource = KendaraanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return static::$resource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge(Kendaraan::query()->count()),
            'active' => Tab::make('Aktif')
                ->badge(Kendaraan::query()->where('berlaku_sampai', '>=', now())->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('berlaku_sampai', '>=', now())),
            'expired' => Tab::make('Kadaluarsa')
                ->badge(Kendaraan::query()->where('berlaku_sampai', '<', now())->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('berlaku_sampai', '<', now())),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'all';
    }
}