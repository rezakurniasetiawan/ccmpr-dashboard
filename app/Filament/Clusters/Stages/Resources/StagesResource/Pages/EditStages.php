<?php

namespace App\Filament\Clusters\Stages\Resources\StagesResource\Pages;

use App\Filament\Clusters\Stages\Resources\StagesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStages extends EditRecord
{
    protected static string $resource = StagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
