<?php
namespace App\Filament\Resources\BeritaAcaraResource\Pages;
use App\Filament\Resources\BeritaAcaraResource;
use Filament\Resources\Pages\ListRecords;
class ListBeritaAcara extends ListRecords { protected static string $resource = BeritaAcaraResource::class; protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
