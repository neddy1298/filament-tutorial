<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MasterAnggaranResource\Pages;
use App\Filament\Resources\MasterAnggaranResource\RelationManagers;
use App\Models\MasterAnggaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MasterAnggaranResource extends Resource
{
    protected static ?string $model = MasterAnggaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Tahunan';

    protected static ?string $navigationGroup = 'Anggaran';

    protected static ?string $modelLabel = 'Anggaran Tahunan';

    protected static ?string $pluralModelLabel = 'Anggaran Tahunan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_rekening')
                    ->required(),
                Forms\Components\TextInput::make('nama_rekening')
                    ->required(),
                Forms\Components\TextInput::make('anggaran')
                    ->required()
                    ->prefix('Rp ')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_rekening')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_rekening')
                    ->searchable(),
                Tables\Columns\TextColumn::make('anggaran')
                    ->prefix('Rp ')
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
            'index' => Pages\ListMasterAnggarans::route('/'),
            'create' => Pages\CreateMasterAnggaran::route('/create'),
            'view' => Pages\ViewMasterAnggaran::route('/{record}'),
            'edit' => Pages\EditMasterAnggaran::route('/{record}/edit'),
        ];
    }
}
