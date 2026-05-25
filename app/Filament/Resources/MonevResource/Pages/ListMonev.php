<?php
namespace App\Filament\Resources\MonevResource\Pages;
use App\Filament\Resources\MonevResource;
use Filament\Resources\Pages\ListRecords;
class ListMonev extends ListRecords { protected static string $resource = MonevResource::class; protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
