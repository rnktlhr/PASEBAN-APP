<?php
namespace App\Filament\Resources\MonevResource\Pages;
use App\Filament\Resources\MonevResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditMonev extends EditRecord { protected static string $resource = MonevResource::class; protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }     protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
