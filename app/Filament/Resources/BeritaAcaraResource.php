<?php

namespace App\Filament\Resources;

use App\Enums\KategoriBeritaAcara;
use App\Filament\Resources\BeritaAcaraResource\Pages;
use App\Models\BeritaAcara;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BeritaAcaraResource extends Resource
{
    protected static ?string $model = BeritaAcara::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $pluralModelLabel = 'Berita Acara';
    protected static string | \UnitEnum | null $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Berita Acara';
    protected static ?int $navigationSort = 1;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Schema $form): Schema
    {
        return $form->components([
            Forms\Components\Section::make('Informasi Utama')
                ->schema([
                    Forms\Components\TextInput::make('judul')
                        ->required()->maxLength(255)->columnSpanFull(),
                    Forms\Components\DatePicker::make('tanggal')->required(),
                    Forms\Components\Select::make('kategori')
                        ->options(KategoriBeritaAcara::options())
                        ->required(),
                    Forms\Components\FileUpload::make('gambar')
                        ->label('Gambar Utama / Cover (Opsional)')
                        ->helperText('Hanya jika ingin cover berbeda. Jika dikosongkan, foto pertama di kotak Narasi bawah akan otomatis dijadikan cover.')
                        ->image()
                        ->maxSize(2048)
                        ->disk('public')
                        ->directory('berita-acara')
                        ->columnSpanFull(),
                ])->columns(2),
                
            Forms\Components\Section::make('Konten')
                ->schema([
                    Forms\Components\Textarea::make('ringkasan')
                        ->helperText('Ringkasan singkat untuk ditampilkan di halaman depan.')
                        ->columnSpanFull()->rows(3),
                    Forms\Components\RichEditor::make('narasi')
                        ->helperText('Isi lengkap berita acara.')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')->searchable()->sortable()->limit(50),
                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')->searchable()->sortable()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendampingan' => 'info',
                        'pembinaan' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('tanggal')->date('d M Y')->sortable(),
            ])->filters([
                //
            ])->actions([
            \Filament\Actions\EditAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ])->bulkActions([
            \Filament\Actions\BulkActionGroup::make([
                \Filament\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeritaAcara::route('/'),
            'create' => Pages\CreateBeritaAcara::route('/create'),
            'edit' => Pages\EditBeritaAcara::route('/{record}/edit'),
        ];
    }
}
