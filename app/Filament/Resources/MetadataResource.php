<?php

namespace App\Filament\Resources;

use App\Enums\JenisMetadata;
use App\Enums\StatusBps;
use App\Enums\StatusKominfo;
use App\Filament\Resources\MetadataResource\Pages;
use App\Models\Metadata;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MetadataResource extends Resource
{
    protected static ?string $model = Metadata::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $pluralModelLabel = 'Metadata';
    protected static string | \UnitEnum | null $navigationGroup = 'Pemantauan';
    protected static ?string $navigationLabel = 'Metadata';
    protected static ?int $navigationSort = 3;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool
    {
        $u = auth()->user();
        return $u && ($u->isAdmin() || $u->isKominfo());
    }

    public static function form(Schema $form): Schema
    {
        $user = auth()->user();
        return $form->components([
            Forms\Components\Select::make('kegiatan_id')
                ->relationship('kegiatanStatistik', 'nama')
                ->searchable()->preload()->required()
                ->disabled(fn () => !$user?->isAdmin()),
            Forms\Components\Select::make('jenis')
                ->options(JenisMetadata::options())
                ->required()
                ->disabled(fn () => !$user?->isAdmin()),
            Forms\Components\TextInput::make('tahun')
                ->numeric()->required()
                ->disabled(fn () => !$user?->isAdmin()),
            Forms\Components\Select::make('status_kominfo')
                ->options(StatusKominfo::metadataOptions())
                ->required()
                ->disabled(fn () => !($user?->isAdmin() || $user?->isKominfo())),
            Forms\Components\Select::make('status_bps')
                ->options(StatusBps::options())
                ->required()
                ->disabled(fn () => !$user?->isAdmin()),
            Forms\Components\Textarea::make('catatan')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->striped()
            ->columns([
            Tables\Columns\TextColumn::make('kegiatanStatistik.dinas.singkatan')
                ->label('Dinas')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('kegiatanStatistik.nama')
                ->label('Kegiatan')->limit(30)->searchable(),
            Tables\Columns\TextColumn::make('jenis')
                ->badge()
                ->alignCenter()
                ->color(fn ($state) => match (is_object($state) ? $state->value : $state) {
                    'kegiatan' => 'primary',
                    'variabel' => 'info',
                    'indikator' => 'success',
                    default => 'gray',
                }),
            Tables\Columns\TextColumn::make('tahun')->alignCenter()->sortable(),
            Tables\Columns\SelectColumn::make('status_kominfo')
                ->options(StatusKominfo::metadataOptions())
                ->disabled(fn () => !(auth()->user()?->isAdmin() || auth()->user()?->isKominfo()))
                ,
            Tables\Columns\SelectColumn::make('status_bps')
                ->options(StatusBps::options())
                ->disabled(fn () => !auth()->user()?->isAdmin())
                ,
        ])->filters([
            Tables\Filters\SelectFilter::make('jenis')
                ->options(JenisMetadata::options()),
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
            'index' => Pages\ListMetadata::route('/'),
            'edit' => Pages\EditMetadata::route('/{record}/edit'),
        ];
    }
}
