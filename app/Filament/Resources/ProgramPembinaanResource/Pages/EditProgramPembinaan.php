<?php

namespace App\Filament\Resources\ProgramPembinaanResource\Pages;

use App\Filament\Resources\ProgramPembinaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgramPembinaan extends EditRecord
{
    protected static string $resource = ProgramPembinaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
