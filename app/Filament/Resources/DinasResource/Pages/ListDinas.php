<?php
namespace App\Filament\Resources\DinasResource\Pages;
use App\Filament\Resources\DinasResource;
use Filament\Resources\Pages\ListRecords;
class ListDinas extends ListRecords { protected static string $resource = DinasResource::class; protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
