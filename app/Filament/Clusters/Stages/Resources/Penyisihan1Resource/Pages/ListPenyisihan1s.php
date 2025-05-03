<?php

namespace App\Filament\Clusters\Stages\Resources\Penyisihan1Resource\Pages;

use App\Filament\Clusters\Stages\Resources\Penyisihan1Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenyisihan1s extends ListRecords
{
    protected static string $resource = Penyisihan1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
