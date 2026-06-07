<?php

namespace App\Filament\Resources\ProgramPembinaanResource\Pages;

use App\Filament\Resources\ProgramPembinaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramPembinaans extends ListRecords
{
    protected static string $resource = ProgramPembinaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
