<?php
namespace App\Filament\Resources;

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
            Forms\Components\Select::make('kegiatan_id')->relationship('kegiatanStatistik', 'nama')->searchable()->preload()->required()->disabled(fn () => !$user?->isAdmin()),
            Forms\Components\TextInput::make('tahun')->numeric()->required()->disabled(fn () => !$user?->isAdmin()),
            Forms\Components\Select::make('status_dinas')->options(['belum_diajukan' => 'Belum Diajukan', 'sudah_diajukan' => 'Sudah Diajukan', 'belum_diperbaiki' => 'Belum Diperbaiki', 'sudah_diperbaiki' => 'Sudah Diperbaiki'])->required()->disabled(fn () => !($user?->isAdmin() || $user?->isDinas())),
            Forms\Components\Select::make('status_kominfo')->options(['sedang_diperiksa' => 'Sedang Diperiksa', 'disetujui' => 'Disetujui'])->required()->disabled(fn () => !($user?->isAdmin() || $user?->isKominfo())),
            Forms\Components\Select::make('status_bps')->options(['sedang_diperiksa' => 'Sedang Diperiksa', 'perlu_perbaikan' => 'Perlu Perbaikan', 'disetujui' => 'Disetujui'])->required()->disabled(fn () => !$user?->isAdmin()),
            Forms\Components\DatePicker::make('tanggal_pengajuan'),
            Forms\Components\DatePicker::make('tanggal_persetujuan'),
            Forms\Components\Textarea::make('catatan')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('kegiatanStatistik.dinas.singkatan')->label('Dinas')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('kegiatanStatistik.nama')->label('Kegiatan')->limit(30)->searchable(),
            Tables\Columns\TextColumn::make('tahun')->sortable(),
            Tables\Columns\SelectColumn::make('status_dinas')->options(['belum_diajukan' => 'Belum Diajukan', 'sudah_diajukan' => 'Sudah Diajukan', 'belum_diperbaiki' => 'Belum Diperbaiki', 'sudah_diperbaiki' => 'Sudah Diperbaiki'])->disabled(fn () => ! (auth()->user()?->isAdmin() || auth()->user()?->isDinas())),
            Tables\Columns\SelectColumn::make('status_kominfo')->options(['sedang_diperiksa' => 'Sedang Diperiksa', 'disetujui' => 'Disetujui'])->disabled(fn () => ! (auth()->user()?->isAdmin() || auth()->user()?->isKominfo())),
            Tables\Columns\SelectColumn::make('status_bps')->options(['sedang_diperiksa' => 'Sedang Diperiksa', 'perlu_perbaikan' => 'Perlu Perbaikan', 'disetujui' => 'Disetujui'])->disabled(fn () => ! auth()->user()?->isAdmin()),
        ])->filters([
            Tables\Filters\SelectFilter::make('status_bps')->options(['sedang_diperiksa' => 'Sedang Diperiksa', 'perlu_perbaikan' => 'Perlu Perbaikan', 'disetujui' => 'Disetujui']),
        ])->actions([Tables\Actions\EditAction::make()]);
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
        return ['index' => Pages\ListRomantik::route('/'), 'edit' => Pages\EditRomantik::route('/{record}/edit')];
    }
}
