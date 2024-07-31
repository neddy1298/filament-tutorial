<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BelanjaResource\Pages;
use App\Models\Belanja;
use App\Models\Maintenance;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BelanjaResource extends Resource
{
    protected static ?string $model = Belanja::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationLabel = 'Belanja';

    protected static ?string $modelLabel = 'Belanja';

    protected static ?string $pluralModelLabel = 'Belanja';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('maintenance_id')
                    ->columnSpan(2)
                    ->required()
                    ->label('Nomor Registrasi')
                    ->options(Maintenance::all()->pluck('kendaraan.nomor_registrasi', 'id'))
                    ->native(false)
                    ->searchable(),
                TextInput::make('belanja_bahan_bakar_minyak')
                    ->numeric(),
                TextInput::make('belanja_pelumas_mesin')
                    ->numeric(),
                TextInput::make('belanja_suku_cadang')
                    ->numeric(),
                DatePicker::make('tanggal_belanja')
                    ->native(false)
                    ->required(),
                Textarea::make('keterangan')
                    ->columnSpan(2)
                    ->autosize()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('maintenance.kendaraan.nomor_registrasi')
                    ->searchable(),
                TextColumn::make('belanja_bahan_bakar_minyak')
                    ->prefix('Rp ')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('belanja_pelumas_mesin')
                    ->prefix('Rp ')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('belanja_suku_cadang')
                    ->prefix('Rp ')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tanggal_belanja')
                    ->searchable(),
                TextColumn::make('keterangan')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListBelanjas::route('/'),
        ];
    }
}
