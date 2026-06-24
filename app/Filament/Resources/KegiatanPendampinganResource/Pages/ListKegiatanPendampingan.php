<?php
namespace App\Filament\Resources\KegiatanPendampinganResource\Pages;
use App\Filament\Resources\KegiatanPendampinganResource;
use Filament\Resources\Pages\ListRecords;
class ListKegiatanPendampingan extends ListRecords { protected static string $resource = KegiatanPendampinganResource::class; protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
