<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KendaraanResource\Pages;
use App\Filament\Resources\KendaraanResource\RelationManagers;
use App\Models\Kendaraan;
use App\Models\UnitKerja;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Kendaraan';

    protected static ?string $navigationGroup = 'Data Master';

    protected static ?string $modelLabel = 'Kendaraan';

    protected static ?string $pluralModelLabel = 'Kendaraan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor_registrasi')
                    ->required()
                    ->autocapitalize('words')
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('unit_kerja_id')
                    ->options(UnitKerja::all()->pluck('nama_unit_kerja', 'id'))
                    ->native(false)
                    ->searchable(),
                Forms\Components\TextInput::make('merk_kendaraan')
                    ->required(),
                Forms\Components\TextInput::make('jenis_kendaraan')
                    ->required(),
                Forms\Components\TextInput::make('cc_kendaraan')
                    ->required()
                    ->suffix(' CC')
                    ->numeric(),
                Forms\Components\Select::make('bbm_kendaraan')
                    ->required()
                    ->options([
                        'bensin' => 'Bensin',
                        'solar' => 'Solar',
                    ])
                    ->native(false),
                Forms\Components\TextInput::make('roda_kendaraan')
                    ->required(),
                Forms\Components\DatePicker::make('berlaku_sampai')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_registrasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unitKerja.nama_unit_kerja')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('merk_kendaraan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kendaraan')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('cc_kendaraan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->suffix(' CC')
                    ->sortable(),
                Tables\Columns\TextColumn::make('bbm_kendaraan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roda_kendaraan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('berlaku_sampai')
                    ->date()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        default => (strtotime($state) < time()) ? 'danger' : 'success',
                    })
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('unit_kerja')
                    ->options(UnitKerja::all()->pluck('nama_unit_kerja', 'id'))
                    ->query(function (Builder $query, array $data): Builder {
                        if (empty($data['values'])) {
                            return $query;
                        }
                        return $query->whereIn('unit_kerja_id', $data['values']);
                    })
                    ->multiple()
                    ->searchable(),
                SelectFilter::make('berlaku_sampai')
                    ->options([
                        'kadaluarsa' => 'Kadaluarsa',
                        'aktif' => 'Aktif',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if ($data['value'] === 'kadaluarsa') {
                            return $query->whereDate('berlaku_sampai', '<', now());
                        }
                        if ($data['value'] === 'aktif') {
                            return $query->whereDate('berlaku_sampai', '>=', now());
                        }
                        return $query;
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                
                ExportBulkAction::make(),
            ]);
    }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKendaraans::route('/'),
            'create' => Pages\CreateKendaraan::route('/create'),
            'view' => Pages\ViewKendaraan::route('/{record}'),
            'edit' => Pages\EditKendaraan::route('/{record}/edit'),
        ];
    }
}
