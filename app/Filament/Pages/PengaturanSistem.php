<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;

/**
 * Halaman "Pengaturan Sistem": mengelola profil aplikasi & instansi
 * yang sebelumnya ditulis statis di file Blade / config.
 *
 * @property-read Schema $form
 */
class PengaturanSistem extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string | \UnitEnum | null $navigationGroup = 'Sistem';

    protected static ?int $navigationSort = 90;

    protected static ?string $slug = 'pengaturan-sistem';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function getNavigationLabel(): string
    {
        return __('messages.settings.navigation');
    }

    public function getTitle(): string | Htmlable
    {
        return __('messages.settings.title');
    }

    public function mount(): void
    {
        $values = [];
        foreach (array_keys(config('paseban.settings', [])) as $key) {
            $values[$key] = Setting::get($key);
        }

        $this->form->fill($values);
    }

    public function form(Schema $schema): Schema
    {
        $groups = collect(config('paseban.settings', []))
            ->map(fn (array $def, string $key) => ['key' => $key, 'type' => $def[1], 'group' => $def[2], 'label' => $def[3]])
            ->groupBy('group');

        $sections = $groups->map(function ($items, string $group) {
            return Section::make(__("messages.settings.groups.{$group}"))
                ->columns(2)
                ->schema($items->map(fn (array $item) => $this->makeField($item))->values()->all());
        })->values()->all();

        return $schema
            ->components($sections)
            ->statePath('data');
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form')
                ->livewireSubmitHandler('save')
                ->footer([
                    Actions::make([
                        Action::make('save')
                            ->label(__('messages.settings.save'))
                            ->submit('save')
                            ->keyBindings(['mod+s']),
                    ]),
                ]),
        ]);
    }

    public function save(): void
    {
        abort_unless(static::canAccess(), 403);

        $data = $this->form->getState();

        foreach (array_keys(config('paseban.settings', [])) as $key) {
            if (array_key_exists($key, $data)) {
                Setting::set($key, $data[$key]);
            }
        }

        Setting::flushCache();

        Notification::make()
            ->success()
            ->title(__('messages.settings.saved'))
            ->send();
    }

    /**
     * Bangun komponen input sesuai tipe pengaturan.
     */
    protected function makeField(array $item): TextInput | Textarea
    {
        $field = match ($item['type']) {
            'text' => Textarea::make($item['key'])->rows(3)->maxLength(1000)->columnSpanFull(),
            'email' => TextInput::make($item['key'])->email()->maxLength(255),
            'url' => TextInput::make($item['key'])->url()->maxLength(500)->columnSpanFull(),
            'integer' => TextInput::make($item['key'])->integer(),
            default => TextInput::make($item['key'])->maxLength(255),
        };

        return $field->label($item['label'])->required();
    }
}
