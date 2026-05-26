<?php

namespace App\Filament\Resources;

use App\Enums\JenisKegiatan;
use App\Filament\Resources\KegiatanStatistikResource\Pages;
use App\Models\KegiatanStatistik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KegiatanStatistikResource extends Resource
{
    protected static ?string $model = KegiatanStatistik::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Pemantauan';
    protected static ?string $navigationLabel = 'Kegiatan Statistik';
    protected static ?int $navigationSort = 1;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool
    {
        $user = auth()->user();
        return $user && ($user->isAdmin() || $user->isKominfo() || $user->isDinas());
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('dinas_id')
                ->relationship('dinas', 'nama')
                ->searchable()->preload()->required()
                ->label('Dinas / OPD'),
            Forms\Components\TextInput::make('nama')
                ->required()->maxLength(255),
            Forms\Components\Select::make('jenis')
                ->options(JenisKegiatan::options())
                ->required(),
            Forms\Components\TextInput::make('tahun')
                ->numeric()->required()->default(date('Y')),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('dinas.singkatan')
                ->label('Dinas')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('nama')
                ->searchable()->sortable()->limit(40),
            Tables\Columns\TextColumn::make('jenis')
                ->badge()
                ->color(fn ($state) => $state instanceof JenisKegiatan ? $state->color() : 'gray'),
            Tables\Columns\TextColumn::make('tahun')->sortable(),
        ])->filters([
            Tables\Filters\SelectFilter::make('tahun')
                ->options(fn () => KegiatanStatistik::distinct()->pluck('tahun', 'tahun')->toArray()),
            Tables\Filters\SelectFilter::make('jenis')
                ->options(JenisKegiatan::options()),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth()->user();
        if ($user?->isDinas() && $user->dinas_id) {
            $query->where('dinas_id', $user->dinas_id);
        }
        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKegiatanStatistik::route('/'),
            'create' => Pages\CreateKegiatanStatistik::route('/create'),
            'edit' => Pages\EditKegiatanStatistik::route('/{record}/edit'),
        ];
    }
}
