<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitKerjaResource\Pages;
use App\Filament\Resources\UnitKerjaResource\RelationManagers;
use App\Models\GroupAnggaran;
use App\Models\UnitKerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnitKerjaResource extends Resource
{
    protected static ?string $model = UnitKerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Unit Kerja';

    protected static ?string $navigationGroup = 'Data Master';

    protected static ?string $modelLabel = 'Unit Kerja';

    protected static ?string $pluralModelLabel = 'Unit Kerja';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('Group_anggaran_id')
                    ->required()
                    ->label('Group Anggaran')
                    ->options(GroupAnggaran::all()->mapWithKeys(function ($item) {
                        return [$item->id => $item->nama_group . ' - ' . $item->kode_rekening];
                    }))
                    ->searchable(),
                Forms\Components\TextInput::make('nama_unit_kerja')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_unit_kerja')
                    ->searchable(),
                Tables\Columns\TextColumn::make('groupAnggaran.nama_group')
                    ->searchable()
                    ->label('Nama Group')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('groupAnggaran.kode_rekening')
                    ->searchable()
                    ->label('Kode Rekening Group')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('groupAnggaran.anggaran_bahan_bakar_minyak')
                    ->prefix('Rp ')
                    ->numeric()
                    ->label('Anggaran BBM')
                    ->sortable(),
                Tables\Columns\TextColumn::make('groupAnggaran.anggaran_pelumas_mesin')
                    ->prefix('Rp ')
                    ->numeric()
                    ->label('Anggaran Pelumas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('groupAnggaran.anggaran_suku_cadang')
                    ->prefix('Rp ')
                    ->numeric()
                    ->label('Anggaran Suku Cadang')
                    ->sortable(),
                Tables\Columns\TextColumn::make('groupAnggaran.anggaran_total')
                    ->prefix('Rp ')
                    ->numeric()
                    ->label('Anggaran Total')
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
                // Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListUnitKerjas::route('/'),
            // 'create' => Pages\CreateUnitKerja::route('/create'),
            // 'view' => Pages\ViewUnitKerja::route('/{record}'),
            // 'edit' => Pages\EditUnitKerja::route('/{record}/edit'),
        ];
    }
}
