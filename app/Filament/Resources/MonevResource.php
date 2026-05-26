<?php

namespace App\Filament\Resources;

use App\Enums\StatusMonev;
use App\Filament\Resources\MonevResource\Pages;
use App\Models\Monev;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MonevResource extends Resource
{
    protected static ?string $model = Monev::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $pluralModelLabel = 'Monitoring Evaluasi';
    protected static ?string $navigationGroup = 'Pemantauan';
    protected static ?string $navigationLabel = 'Monitoring & Evaluasi';
    protected static ?int $navigationSort = 5;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Form $form): Form
    {
        $bulanOptions = config('paseban.bulan');

        return $form->schema([
            Forms\Components\Select::make('kegiatan_id')
                ->relationship('kegiatanStatistik', 'nama')
                ->searchable()->preload()->required(),
            Forms\Components\TextInput::make('tahun')
                ->numeric()->required()->default(date('Y')),
            Forms\Components\Select::make('bulan_rencana_mulai')
                ->options($bulanOptions)->required(),
            Forms\Components\Select::make('bulan_rencana_selesai')
                ->options($bulanOptions)->required(),
            Forms\Components\Select::make('bulan_realisasi_mulai')
                ->options($bulanOptions),
            Forms\Components\Select::make('bulan_realisasi_selesai')
                ->options($bulanOptions),
            Forms\Components\Select::make('status')
                ->options(StatusMonev::options())
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('kegiatanStatistik.nama')
                ->label('Kegiatan')->limit(30)->searchable(),
            Tables\Columns\TextColumn::make('tahun')->sortable(),
            Tables\Columns\TextColumn::make('bulan_rencana_mulai')
                ->label('Rencana'),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn ($state) => $state instanceof StatusMonev ? $state->color() : 'gray')
                ,
        ])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
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
            'index' => Pages\ListMonev::route('/'),
            'create' => Pages\CreateMonev::route('/create'),
            'edit' => Pages\EditMonev::route('/{record}/edit'),
        ];
    }
}
