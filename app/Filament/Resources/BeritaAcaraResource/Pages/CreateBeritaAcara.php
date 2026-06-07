<?php
namespace App\Filament\Resources\BeritaAcaraResource\Pages;
use App\Filament\Resources\BeritaAcaraResource;
use Filament\Resources\Pages\CreateRecord;
class CreateBeritaAcara extends CreateRecord { protected static string $resource = BeritaAcaraResource::class;     protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
