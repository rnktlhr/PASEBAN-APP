<?php
namespace App\Filament\Resources;
use App\Filament\Resources\PembinaanResource\Pages;
use App\Models\Pembinaan;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PembinaanResource extends Resource
{
    protected static ?string $model = Pembinaan::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $pluralModelLabel = 'Pembinaan Statistik';
    protected static string | \UnitEnum | null $navigationGroup = 'Pembinaan';
    protected static ?string $navigationLabel = 'Sesi Pembinaan';
    protected static ?int $navigationSort = 1;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool { return auth()->user()?->isAdmin() ?? false; }
    public static function form(Schema $form): Schema
    {
        return $form->components([
            Forms\Components\TextInput::make('judul')->required()->maxLength(255)->columnSpanFull(),
            Forms\Components\DatePicker::make('tanggal')->required(),
            Forms\Components\Textarea::make('deskripsi')->columnSpanFull(),
            Forms\Components\FileUpload::make('file_absensi')
                ->label('Upload Absensi (CSV/Spreadsheet)')
                ->acceptedFileTypes(['text/csv', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                ->helperText('Kolom CSV: nama_dinas, hadir (ya/tidak). Contoh: "Dinas Sosial, ya"')
                ->directory('absensi')
                ->columnSpanFull(),
        ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->striped()
            ->columns([
            Tables\Columns\TextColumn::make('dinas.singkatan')
                ->label('Dinas')->searchable()->sortable()->size(\Filament\Support\Enums\TextSize::Large),
            Tables\Columns\TextColumn::make('judul')
                ->limit(30)->searchable()->size(\Filament\Support\Enums\TextSize::Large),
            Tables\Columns\TextColumn::make('tanggal')->date('d M Y')->sortable()->size(\Filament\Support\Enums\TextSize::Large),
            Tables\Columns\TextColumn::make('presensi_count')->counts('presensi')->label('Total Presensi'),
            Tables\Columns\TextColumn::make('file_absensi')->label('File')->limit(20),
        ])->actions([\Filament\Actions\EditAction::make(), \Filament\Actions\DeleteAction::make()]);
    }
    public static function getPages(): array
    {
        return ['index' => Pages\ListPembinaan::route('/'), 'create' => Pages\CreatePembinaan::route('/create'), 'edit' => Pages\EditPembinaan::route('/{record}/edit')];
    }
}
