<?php
namespace App\Filament\Resources\KegiatanPendampinganResource\Pages;
use App\Filament\Resources\KegiatanPendampinganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditKegiatanPendampingan extends EditRecord { protected static string $resource = KegiatanPendampinganResource::class; protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }     protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); } }
