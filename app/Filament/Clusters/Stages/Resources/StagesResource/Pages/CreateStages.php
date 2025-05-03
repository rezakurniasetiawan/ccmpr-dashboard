<?php

namespace App\Filament\Clusters\Stages\Resources\StagesResource\Pages;

use App\Filament\Clusters\Stages\Resources\StagesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStages extends CreateRecord
{
    protected static string $resource = StagesResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
