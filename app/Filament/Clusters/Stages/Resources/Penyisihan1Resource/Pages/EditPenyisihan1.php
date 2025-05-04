<?php

namespace App\Filament\Clusters\Stages\Resources\Penyisihan1Resource\Pages;

use App\Filament\Clusters\Stages\Resources\Penyisihan1Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenyisihan1 extends EditRecord
{
    protected static string $resource = Penyisihan1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
