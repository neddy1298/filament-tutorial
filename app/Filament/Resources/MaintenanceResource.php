<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceResource\Pages;
use App\Filament\Resources\MaintenanceResource\RelationManagers;
use App\Models\Kendaraan;
use App\Models\Maintenance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceResource extends Resource
{
    protected static ?string $model = Maintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationLabel = 'Maintenance';

    protected static ?string $modelLabel = 'Maintenance';

    protected static ?string $pluralModelLabel = 'Maintenance';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kendaraan_id')
                    ->required()
                    ->label('Nomor Registrasi')
                    ->options(Kendaraan::all()->pluck('nomor_registrasi', 'id'))
                    ->native(false)
                    ->searchable(),
                Forms\Components\TextInput::make('belanja_bahan_bakar_minyak')
                    ->numeric(),
                Forms\Components\TextInput::make('belanja_pelumas_mesin')
                    ->numeric(),
                Forms\Components\TextInput::make('belanja_suku_cadang')
                    ->numeric(),
                Forms\Components\Textarea::make('keterangan')
                    ->autosize(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kendaraan.nomor_registrasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('belanja_bahan_bakar_minyak')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('belanja_pelumas_mesin')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('belanja_suku_cadang')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListMaintenances::route('/'),
            'view' => Pages\ViewMaintenance::route('/{record}'),
        ];
    }
}
