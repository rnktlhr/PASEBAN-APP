<?php

namespace App\Filament\Resources\MateriPembinaanResource\Pages;

use App\Filament\Resources\MateriPembinaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMateriPembinaans extends ListRecords
{
    protected static string $resource = MateriPembinaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
