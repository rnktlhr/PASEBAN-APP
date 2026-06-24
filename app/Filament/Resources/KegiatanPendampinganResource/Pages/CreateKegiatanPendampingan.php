<?php
namespace App\Filament\Resources\KegiatanPendampinganResource\Pages;
use App\Filament\Resources\KegiatanPendampinganResource;
use Filament\Resources\Pages\CreateRecord;
class CreateKegiatanPendampingan extends CreateRecord { protected static string $resource = KegiatanPendampinganResource::class;     protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); } }
