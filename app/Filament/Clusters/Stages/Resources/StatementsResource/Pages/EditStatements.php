<?php

namespace App\Filament\Clusters\Stages\Resources\StatementsResource\Pages;

use App\Filament\Clusters\Stages\Resources\StatementsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatements extends EditRecord
{
    protected static string $resource = StatementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
