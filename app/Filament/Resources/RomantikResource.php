<?php

namespace App\Filament\Resources;

use App\Enums\StatusDinas;
use App\Enums\StatusKominfo;
use App\Enums\StatusBps;
use App\Filament\Resources\RomantikResource\Pages;
use App\Models\Romantik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RomantikResource extends Resource
{
    protected static ?string $model = Romantik::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $pluralModelLabel = 'Romantik';
    protected static ?string $navigationGroup = 'Pemantauan';
    protected static ?string $navigationLabel = 'Romantik';
    protected static ?int $navigationSort = 2;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool
    {
        $user = auth()->user();
        return $user && ($user->isAdmin() || $user->isKominfo() || $user->isDinas());
    }

    public static function form(Form $form): Form
    {
        $user = auth()->user();
        return $form->schema([
            Forms\Components\Select::make('kegiatan_id')
                ->relationship('kegiatanStatistik', 'nama')
                ->searchable()->preload()->required()
                ->disabled(fn () => !$user?->isAdmin()),
            Forms\Components\TextInput::make('tahun')
                ->numeric()->required()
                ->disabled(fn () => !$user?->isAdmin()),
            Forms\Components\Select::make('status_dinas')
                ->options(StatusDinas::options())
                ->required()
                ->disabled(fn () => !($user?->isAdmin() || $user?->isDinas())),
            Forms\Components\Select::make('status_kominfo')
                ->options(StatusKominfo::romantikOptions())
                ->required()
                ->disabled(fn () => !($user?->isAdmin() || $user?->isKominfo())),
            Forms\Components\Select::make('status_bps')
                ->options(StatusBps::options())
                ->required()
                ->disabled(fn () => !$user?->isAdmin()),
            Forms\Components\DatePicker::make('tanggal_pengajuan'),
            Forms\Components\DatePicker::make('tanggal_persetujuan'),
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
                ->label('Dinas')->searchable()->sortable()->size(Tables\Columns\TextColumn\TextColumnSize::Large),
            Tables\Columns\TextColumn::make('kegiatanStatistik.nama')
                ->label('Kegiatan')->limit(30)->searchable()->size(Tables\Columns\TextColumn\TextColumnSize::Large),
            Tables\Columns\TextColumn::make('tahun')->sortable()->size(Tables\Columns\TextColumn\TextColumnSize::Large),
            Tables\Columns\SelectColumn::make('status_dinas')
                ->options(StatusDinas::options())
                ->disabled(fn () => !(auth()->user()?->isAdmin() || auth()->user()?->isDinas()))
                ,
            Tables\Columns\SelectColumn::make('status_kominfo')
                ->options(StatusKominfo::romantikOptions())
                ->disabled(fn () => !(auth()->user()?->isAdmin() || auth()->user()?->isKominfo()))
                ,
            Tables\Columns\SelectColumn::make('status_bps')
                ->options(StatusBps::options())
                ->disabled(fn () => !auth()->user()?->isAdmin())
                ,
        ])->filters([
            Tables\Filters\SelectFilter::make('status_bps')
                ->options(StatusBps::options()),
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
            'index' => Pages\ListRomantik::route('/'),
            'edit' => Pages\EditRomantik::route('/{record}/edit'),
        ];
    }
}
