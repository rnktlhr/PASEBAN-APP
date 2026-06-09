<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DinasResource\Pages;
use App\Models\Dinas;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DinasResource extends Resource
{
    protected static ?string $model = Dinas::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-office-2';
    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Dinas / OPD';
    protected static ?int $navigationSort = 1;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Schema $form): Schema
    {
        return $form->components([
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
            ->defaultPaginationPageOption(25)
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->alignCenter()->sortable(),
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('singkatan')->searchable(),
                Tables\Columns\TextColumn::make('kategori')
                    ->badge()
                    ->alignCenter()
                    ->color(function (?string $state): string {
                        if (!$state) return 'gray';
                        $colors = ['primary', 'success', 'warning', 'danger', 'info'];
                        return $colors[abs(crc32($state)) % count($colors)];
                    }),
                Tables\Columns\TextColumn::make('kegiatan_statistik_count')
                    ->counts('kegiatanStatistik')
                    ->label('Jumlah Kegiatan')
                    ->alignCenter()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([\Filament\Actions\EditAction::make(), \Filament\Actions\DeleteAction::make()])
            ->bulkActions([\Filament\Actions\BulkActionGroup::make([\Filament\Actions\DeleteBulkAction::make()])]);
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
