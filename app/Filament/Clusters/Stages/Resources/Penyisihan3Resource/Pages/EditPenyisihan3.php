<?php

namespace App\Filament\Clusters\Stages\Resources\Penyisihan3Resource\Pages;

use App\Filament\Clusters\Stages\Resources\Penyisihan3Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenyisihan3 extends EditRecord
{
    protected static string $resource = Penyisihan3Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
