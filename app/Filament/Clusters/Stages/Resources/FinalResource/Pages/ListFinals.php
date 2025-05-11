<?php

namespace App\Filament\Clusters\Stages\Resources\FinalResource\Pages;

use App\Filament\Clusters\Stages\Resources\FinalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFinals extends ListRecords
{
    protected static string $resource = FinalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
