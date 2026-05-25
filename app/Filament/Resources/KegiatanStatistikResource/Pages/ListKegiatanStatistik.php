<?php
namespace App\Filament\Resources\KegiatanStatistikResource\Pages;
use App\Filament\Resources\KegiatanStatistikResource;
use Filament\Resources\Pages\ListRecords;
class ListKegiatanStatistik extends ListRecords { protected static string $resource = KegiatanStatistikResource::class; protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
