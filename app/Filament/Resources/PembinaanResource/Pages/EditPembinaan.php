<?php
namespace App\Filament\Resources\PembinaanResource\Pages;
use App\Filament\Resources\PembinaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditPembinaan extends EditRecord { protected static string $resource = PembinaanResource::class; protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; } }
