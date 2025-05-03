<?php

namespace App\Filament\Clusters\Stages\Resources\StagesResource\Pages;

use App\Filament\Clusters\Stages\Resources\StagesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStages extends ListRecords
{
    protected static string $resource = StagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
