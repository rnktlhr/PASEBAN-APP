<?php
namespace App\Filament\Resources\PembinaanResource\Pages;
use App\Filament\Resources\PembinaanResource;
use Filament\Resources\Pages\CreateRecord;
class CreatePembinaan extends CreateRecord { protected static string $resource = PembinaanResource::class;     protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
