<?php

namespace App\Filament\Clusters\Stages\Resources\Penyisihan3Resource\Pages;

use App\Filament\Clusters\Stages\Resources\Penyisihan3Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenyisihan3s extends ListRecords
{
    protected static string $resource = Penyisihan3Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
