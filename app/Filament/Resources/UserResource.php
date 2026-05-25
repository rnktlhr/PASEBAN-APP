<?php
namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Pengguna';
    protected static ?int $navigationSort = 2;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool { return auth()->user()?->isAdmin() ?? false; }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->maxLength(255),
            Forms\Components\TextInput::make('email')->email()->required()->maxLength(255),
            Forms\Components\TextInput::make('password')->password()->dehydrated(fn ($state) => filled($state))->required(fn ($livewire) => $livewire instanceof Pages\CreateUser),
            Forms\Components\Select::make('role')->options(['admin_bps' => 'Admin BPS', 'kominfo' => 'Kominfo', 'dinas' => 'Dinas', 'bappeda' => 'Bappeda'])->required(),
            Forms\Components\Select::make('dinas_id')->relationship('dinas', 'nama')->searchable()->preload()->nullable()->label('Dinas / OPD'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('role')->badge()->color(fn (string $state) => match($state) { 'admin_bps' => 'danger', 'kominfo' => 'warning', 'dinas' => 'primary', 'bappeda' => 'gray' }),
            Tables\Columns\TextColumn::make('dinas.singkatan')->label('Dinas'),
        ])->actions([Tables\Actions\EditAction::make()])->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListUsers::route('/'), 'create' => Pages\CreateUser::route('/create'), 'edit' => Pages\EditUser::route('/{record}/edit')];
    }
}
