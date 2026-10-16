<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use App\Models\ActivityLog;
use App\Models\User;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

/**
 * Jejak Audit (read-only) — hanya dapat diakses Admin BPS.
 */
class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-shield-check';

    protected static string | \UnitEnum | null $navigationGroup = 'Sistem';

    protected static ?int $navigationSort = 91;

    protected static bool $isScopedToTenant = false;

    protected static ?string $slug = 'jejak-audit';

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getNavigationLabel(): string
    {
        return __('messages.audit.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('messages.audit.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('messages.audit.title');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with('user'))
            ->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(25)
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('messages.audit.columns.time'))
                    ->dateTime('d M Y H:i:s')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.nama')
                    ->label(__('messages.audit.columns.user'))
                    ->placeholder(__('messages.audit.system'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('action')
                    ->label(__('messages.audit.columns.action'))
                    ->badge()
                    ->formatStateUsing(fn (?string $state) => ActivityLog::actionOptions()[$state] ?? $state)
                    ->color(fn (?string $state) => ActivityLog::actionColor($state))
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('messages.audit.columns.description'))
                    ->limit(60)
                    ->tooltip(fn (ActivityLog $record) => $record->description)
                    ->searchable(),
                Tables\Columns\TextColumn::make('ip_address')
                    ->label(__('messages.audit.columns.ip'))
                    ->fontFamily('mono')
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('action')
                    ->label(__('messages.audit.columns.action'))
                    ->options(ActivityLog::actionOptions()),
                Tables\Filters\SelectFilter::make('user_id')
                    ->label(__('messages.audit.columns.user'))
                    ->options(fn () => User::query()->orderBy('nama')->pluck('nama', 'id')->all())
                    ->searchable(),
            ])
            ->actions([
                ViewAction::make(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->columns(2)
                ->schema([
                    TextEntry::make('created_at')->label(__('messages.audit.columns.time'))->dateTime('d M Y H:i:s'),
                    TextEntry::make('user.nama')->label(__('messages.audit.columns.user'))->placeholder(__('messages.audit.system')),
                    TextEntry::make('action')
                        ->label(__('messages.audit.columns.action'))
                        ->badge()
                        ->formatStateUsing(fn (?string $state) => ActivityLog::actionOptions()[$state] ?? $state)
                        ->color(fn (?string $state) => ActivityLog::actionColor($state)),
                    TextEntry::make('ip_address')->label(__('messages.audit.columns.ip')),
                    TextEntry::make('description')->label(__('messages.audit.columns.description'))->columnSpanFull(),
                    TextEntry::make('user_agent')->label(__('messages.audit.columns.user_agent'))->columnSpanFull(),
                    TextEntry::make('old_values_display')
                        ->label(__('messages.audit.columns.old_values'))
                        ->state(fn (ActivityLog $record) => static::formatJson($record->old_values))
                        ->columnSpanFull(),
                    TextEntry::make('new_values_display')
                        ->label(__('messages.audit.columns.new_values'))
                        ->state(fn (ActivityLog $record) => static::formatJson($record->new_values))
                        ->columnSpanFull(),
                ]),
        ]);
    }

    /**
     * Tampilkan JSON terformat dengan aman (di-escape).
     */
    protected static function formatJson(?array $values): HtmlString | string
    {
        if (empty($values)) {
            return '-';
        }

        $json = json_encode($values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return new HtmlString(
            '<pre style="white-space:pre-wrap;font-size:12px;max-height:320px;overflow:auto;">'.e($json).'</pre>'
        );
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogs::route('/'),
        ];
    }
}
