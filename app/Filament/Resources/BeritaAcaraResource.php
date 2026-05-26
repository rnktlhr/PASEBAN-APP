<?php

namespace App\Filament\Resources;

use App\Enums\KategoriBeritaAcara;
use App\Filament\Resources\BeritaAcaraResource\Pages;
use App\Models\BeritaAcara;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BeritaAcaraResource extends Resource
{
    protected static ?string $model = BeritaAcara::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $pluralModelLabel = 'Berita Acara';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Berita Acara';
    protected static ?int $navigationSort = 1;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
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
        return $table->columns([
            Tables\Columns\TextColumn::make('judul')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('tanggal')->date('d M Y')->sortable(),
            Tables\Columns\TextColumn::make('kategori')
                ->badge()
                ->color(fn ($state) => $state instanceof KategoriBeritaAcara ? $state->color() : 'gray')
                ,
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
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
