<?php
namespace App\Filament\Resources\MonevResource\Pages;
use App\Filament\Resources\MonevResource;
use Filament\Resources\Pages\CreateRecord;
class CreateMonev extends CreateRecord { protected static string $resource = MonevResource::class;     protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
