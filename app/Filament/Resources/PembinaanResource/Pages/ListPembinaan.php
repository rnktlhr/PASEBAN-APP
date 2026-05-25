<?php
namespace App\Filament\Resources\PembinaanResource\Pages;
use App\Filament\Resources\PembinaanResource;
use Filament\Resources\Pages\ListRecords;
class ListPembinaan extends ListRecords { protected static string $resource = PembinaanResource::class; protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
