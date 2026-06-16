<?php

namespace App\Filament\Resources;

use App\Enums\FrekuensiData;
use App\Filament\Resources\AliranDataResource\Pages;
use App\Models\AliranData;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AliranDataResource extends Resource
{
    protected static ?string $model = AliranData::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-arrow-trending-up';
    protected static ?string $pluralModelLabel = 'Aliran Data';
    protected static string | \UnitEnum | null $navigationGroup = 'Pemantauan';
    protected static ?string $navigationLabel = 'Aliran Data';
    protected static ?int $navigationSort = 4;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Schema $form): Schema
    {
        return $form->components([
            Forms\Components\Select::make('kegiatan_id')
                ->relationship('kegiatanStatistik', 'nama')
                ->searchable()->preload()->required(),
            Forms\Components\TextInput::make('nama_data')
                ->required()->maxLength(255),
            Forms\Components\TextInput::make('tahun')
                ->numeric()->required()->default(date('Y')),
            Forms\Components\Select::make('frekuensi')
                ->options(FrekuensiData::options())
                ->required(),
            Forms\Components\Toggle::make('sudah_tayang')
                ->label('Sudah Tayang di Sedata Sebantul'),
            Forms\Components\DatePicker::make('tanggal_tayang'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->defaultPaginationPageOption(25)
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('kegiatanStatistik.dinas.singkatan')
                    ->label('Dinas')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('kegiatanStatistik.nama')
                    ->label('Kegiatan')->limit(20)->searchable(),
                Tables\Columns\TextColumn::make('nama_data')->limit(20)->searchable(),
                Tables\Columns\TextColumn::make('tahun')->alignCenter()->sortable(),
                Tables\Columns\IconColumn::make('sudah_tayang')
                    ->boolean()
                    ->size(\Filament\Support\Enums\IconSize::Large),
            ])->filters([
                Tables\Filters\TernaryFilter::make('sudah_tayang')->label('Status Tayang'),
            ])->actions([\Filament\Actions\EditAction::make(), \Filament\Actions\DeleteAction::make()]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth()->user();
        if ($user?->isDinas() && $user->dinas_id) {
            $query->whereHas('kegiatanStatistik', fn ($q) => $q->where('dinas_id', $user->dinas_id));
        }
        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAliranData::route('/'),
            'create' => Pages\CreateAliranData::route('/create'),
            'edit' => Pages\EditAliranData::route('/{record}/edit'),
        ];
    }
}
