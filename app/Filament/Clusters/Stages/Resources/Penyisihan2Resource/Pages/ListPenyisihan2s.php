<?php

namespace App\Filament\Clusters\Stages\Resources\Penyisihan2Resource\Pages;

use App\Filament\Clusters\Stages\Resources\Penyisihan2Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenyisihan2s extends ListRecords
{
    protected static string $resource = Penyisihan2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
