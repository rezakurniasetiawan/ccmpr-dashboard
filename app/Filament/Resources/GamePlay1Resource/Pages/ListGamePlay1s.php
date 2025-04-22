<?php

namespace App\Filament\Resources\GamePlay1Resource\Pages;

use App\Filament\Resources\GamePlay1Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGamePlay1s extends ListRecords
{
    protected static string $resource = GamePlay1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
