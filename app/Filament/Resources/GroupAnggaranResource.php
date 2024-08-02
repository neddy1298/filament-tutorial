<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupAnggaranResource\Pages;
use App\Filament\Resources\GroupAnggaranResource\RelationManagers;
use App\Models\GroupAnggaran;
use App\Models\Maintenance;
use App\Models\MasterAnggaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GroupAnggaranResource extends Resource
{
    protected static ?string $model = GroupAnggaran::class;


    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';

    protected static ?string $navigationLabel = 'Group';

    protected static ?string $navigationGroup = 'Anggaran';

    protected static ?string $modelLabel = 'Group Anggaran';

    protected static ?string $pluralModelLabel = 'Group Anggaran';

    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('master_anggaran_id')
                    ->required()
                    ->label('Kode Master Anggaran')
                    ->options(MasterAnggaran::all()->mapWithKeys(function ($item) {
                        return [$item->id => $item->nama_rekening . ' - ' . $item->kode_rekening];
                    }))
                    ->native(false)
                    ->searchable(),
                Forms\Components\TextInput::make('kode_rekening')
                    ->required(),
                Forms\Components\TextInput::make('nama_group')
                    ->required(),
                Forms\Components\TextInput::make('anggaran_bahan_bakar_minyak')
                    ->numeric(),
                Forms\Components\TextInput::make('anggaran_pelumas_mesin')
                    ->numeric(),
                Forms\Components\TextInput::make('anggaran_suku_cadang')
                    ->numeric(),
                Forms\Components\TextInput::make('anggaran_suku_cadang')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('masterAnggaran.kode_rekening')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kode_rekening')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_group')
                    ->searchable(),
                Tables\Columns\TextColumn::make('anggaran_bahan_bakar_minyak')
                    ->prefix('Rp ')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('anggaran_pelumas_mesin')
                    ->prefix('Rp ')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('anggaran_suku_cadang')
                    ->prefix('Rp ')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('anggaran_total')
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
            'index' => Pages\ListGroupAnggarans::route('/'),
            'create' => Pages\CreateGroupAnggaran::route('/create'),
            'view' => Pages\ViewGroupAnggaran::route('/{record}'),
            'edit' => Pages\EditGroupAnggaran::route('/{record}/edit'),
        ];
    }
}
