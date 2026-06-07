<?php
namespace App\Filament\Resources\RomantikResource\Pages;
use App\Filament\Resources\RomantikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditRomantik extends EditRecord { protected static string $resource = RomantikResource::class;     protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
