<?php

namespace App\Filament\Resources\PembinaanResource\RelationManagers;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PresensiRelationManager extends RelationManager
{
    protected static string $relationship = 'presensi';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Schema $form): Schema
    {
        return $form
            ->components([
                Forms\Components\Select::make('dinas_id')
                    ->relationship('dinas', 'nama')
                    ->required()
                    ->searchable(),
                Forms\Components\Toggle::make('hadir')
                    ->label('Hadir')
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('dinas.nama')->searchable(),
                Tables\Columns\IconColumn::make('hadir')
                    ->boolean()
                    ->label('Hadir'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                \Filament\Actions\CreateAction::make(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
