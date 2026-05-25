<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DinasResource\Pages;
use App\Models\Dinas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DinasResource extends Resource
{
    protected static ?string $model = Dinas::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Dinas / OPD';
    protected static ?int $navigationSort = 1;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')
                ->required()->maxLength(255)->columnSpanFull(),
            Forms\Components\TextInput::make('singkatan')
                ->maxLength(50),
            Forms\Components\TextInput::make('kategori')
                ->maxLength(100),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->width(60),
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('singkatan')->searchable(),
                Tables\Columns\TextColumn::make('kategori')->badge(),
                Tables\Columns\TextColumn::make('kegiatan_statistik_count')
                    ->counts('kegiatanStatistik')
                    ->label('Jumlah Kegiatan')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDinas::route('/'),
            'create' => Pages\CreateDinas::route('/create'),
            'edit'   => Pages\EditDinas::route('/{record}/edit'),
        ];
    }
}
