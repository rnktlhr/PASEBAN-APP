<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Enums\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';
    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Pengguna';
    protected static ?int $navigationSort = 2;
    protected static bool $isScopedToTenant = false;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Schema $form): Schema
    {
        return $form->components([
            Forms\Components\TextInput::make('name')
                ->required()->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()->required()->maxLength(255),
            Forms\Components\TextInput::make('password')
                ->password()
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn ($livewire) => $livewire instanceof Pages\CreateUser),
            Forms\Components\Select::make('role')
                ->options(Role::options())
                ->required(),
            Forms\Components\Select::make('dinas_id')
                ->relationship('dinas', 'nama')
                ->searchable()->preload()->nullable()
                ->label('Dinas / OPD'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->striped()
            ->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('role')
                
                ->badge()
                ->color(fn ($state) => $state instanceof Role ? $state->color() : (Role::tryFrom($state)?->color() ?? 'gray'))
                ->formatStateUsing(fn ($state) => $state instanceof Role ? $state->label() : (Role::tryFrom($state)?->label() ?? $state)),
            Tables\Columns\TextColumn::make('dinas.singkatan')->label('Dinas'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
