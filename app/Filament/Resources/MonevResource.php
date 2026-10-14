<?php

namespace App\Filament\Resources;

use App\Enums\StatusBps;
use App\Enums\StatusMonev;
use App\Filament\Resources\MonevResource\Pages;
use App\Models\Monev;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MonevResource extends Resource
{
    protected static ?string $model = Monev::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $pluralModelLabel = 'Monitoring Evaluasi';
    protected static string | \UnitEnum | null $navigationGroup = 'Pemantauan';
    protected static ?string $navigationLabel = 'Monitoring & Evaluasi';
    protected static ?int $navigationSort = 5;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Schema $form): Schema
    {
        $bulanOptions = config('paseban.bulan');

        return $form->components([
            Forms\Components\Select::make('id_kegiatan')
                ->relationship('kegiatanStatistik', 'nama')
                ->searchable()->preload()->required(),
            Forms\Components\TextInput::make('tahun')
                ->numeric()->required()->default(date('Y')),
            Forms\Components\Select::make('bulan')
                ->options($bulanOptions)->required(),
            Forms\Components\Select::make('status')
                ->options(StatusMonev::options())
                ->required(),
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
            Tables\Columns\TextColumn::make('tahun')->alignCenter()->sortable(),
            Tables\Columns\TextColumn::make('bulan')
                ->label('Bulan')
                ->formatStateUsing(fn ($state) => config("paseban.bulan.{$state}") ?? $state)
                ->alignCenter()
                ->sortable(),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->alignCenter()
                ->color(fn ($state) => $state instanceof StatusMonev ? $state->color() : 'gray'),
            // Romantik & Metadata diambil lewat relasi kegiatan (tidak disimpan di tabel monev).
            Tables\Columns\TextColumn::make('kegiatanStatistik.romantik.status_bps')
                ->label('Romantik')
                ->badge()
                ->alignCenter()
                ->placeholder('-')
                ->formatStateUsing(fn ($state) => self::bps($state)?->label() ?? $state)
                ->color(fn ($state) => self::bps($state)?->color() ?? 'gray'),
            Tables\Columns\TextColumn::make('kegiatanStatistik.romantik.metadata.status_bps')
                ->label('Metadata')
                ->badge()
                ->alignCenter()
                ->placeholder('-')
                ->formatStateUsing(fn ($state) => self::bps($state)?->label() ?? $state)
                ->color(fn ($state) => self::bps($state)?->color() ?? 'gray'),
        ])->filters([        
        ])->actions([\Filament\Actions\EditAction::make(), \Filament\Actions\DeleteAction::make()]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery()
            ->with(['kegiatanStatistik.dinas', 'kegiatanStatistik.romantik.metadata']);
        $user = auth()->user();
        if ($user?->isDinas() && $user->id_dinas) {
            $query->whereHas('kegiatanStatistik', fn ($q) => $q->where('id_dinas', $user->id_dinas));
        }
        return $query;
    }

    private static function bps($state): ?StatusBps
    {
        return $state instanceof StatusBps ? $state : StatusBps::tryFrom((string) $state);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMonev::route('/'),
            'create' => Pages\CreateMonev::route('/create'),
            'edit' => Pages\EditMonev::route('/{record}/edit'),
        ];
    }
}
