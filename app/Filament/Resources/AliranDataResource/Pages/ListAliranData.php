<?php
namespace App\Filament\Resources\AliranDataResource\Pages;
use App\Filament\Resources\AliranDataResource;
use Filament\Resources\Pages\ListRecords;
class ListAliranData extends ListRecords { protected static string $resource = AliranDataResource::class; protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
