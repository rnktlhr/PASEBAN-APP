<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramPembinaanResource\Pages;
use App\Models\ProgramPembinaan;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramPembinaanResource extends Resource
{
    protected static ?string $model = ProgramPembinaan::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $pluralModelLabel = 'Program Pembinaan';
    protected static string | \UnitEnum | null $navigationGroup = 'Pembinaan';
    protected static ?string $navigationLabel = 'Program Tahunan';
    protected static ?int $navigationSort = 0;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Schema $form): Schema
    {
        return $form
            ->components([
                Forms\Components\TextInput::make('tahun')
                    ->required()
                    ->numeric()
                    ->default(date('Y')),
                Forms\Components\TextInput::make('nomor_urut')
                    ->required()
                    ->numeric()
                    ->label('Nomor Urut (Contoh: 1, 2)'),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kuartal')
                    ->maxLength(255)
                    ->placeholder('Contoh: Triwulan I'),
                Forms\Components\TextInput::make('jadwal')
                    ->maxLength(255)
                    ->placeholder('Contoh: Jan - Mar 2026'),
                Forms\Components\TextInput::make('link')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('URL eksternal jika ada'),
                Forms\Components\Textarea::make('deskripsi')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tahun')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nomor_urut')
                    ->sortable()
                    ->label('No'),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kuartal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jadwal')
                    ->searchable(),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProgramPembinaans::route('/'),
            'create' => Pages\CreateProgramPembinaan::route('/create'),
            'edit' => Pages\EditProgramPembinaan::route('/{record}/edit'),
        ];
    }
}
