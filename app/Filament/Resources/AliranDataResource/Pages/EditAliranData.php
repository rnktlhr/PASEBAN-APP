<?php
namespace App\Filament\Resources\AliranDataResource\Pages;
use App\Filament\Resources\AliranDataResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditAliranData extends EditRecord { protected static string $resource = AliranDataResource::class; protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }     protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
