<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MateriPembinaanResource\Pages;
use App\Models\MateriPembinaan;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MateriPembinaanResource extends Resource
{
    protected static ?string $model = MateriPembinaan::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $pluralModelLabel = 'Materi Pembinaan';
    protected static string | \UnitEnum | null $navigationGroup = 'Pembinaan';
    protected static ?string $navigationLabel = 'Pustaka Materi';
    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Schema $form): Schema
    {
        return $form
            ->components([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenis')
                    ->required()
                    ->options([
                        'PDF' => 'PDF',
                        'DOCX' => 'DOCX',
                        'VIDEO' => 'VIDEO',
                        'LAINNYA' => 'LAINNYA',
                    ])
                    ->default('PDF'),
                Forms\Components\DatePicker::make('tanggal'),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Upload File')
                    ->maxSize(10240)
                    ->directory('materi-pembinaan'),
                Forms\Components\TextInput::make('link_url')
                    ->label('Link URL (Khusus Video / Eksternal)')
                    ->url()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ukuran_file')
                    ->label('Ukuran File (Contoh: 1.8 MB)')
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ukuran_file'),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMateriPembinaans::route('/'),
            'create' => Pages\CreateMateriPembinaan::route('/create'),
            'edit' => Pages\EditMateriPembinaan::route('/{record}/edit'),
        ];
    }
}
