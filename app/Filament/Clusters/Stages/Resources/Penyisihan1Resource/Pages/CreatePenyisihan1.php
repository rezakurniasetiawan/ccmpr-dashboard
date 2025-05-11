<?php

namespace App\Filament\Clusters\Stages\Resources\Penyisihan1Resource\Pages;

use App\Filament\Clusters\Stages\Resources\Penyisihan1Resource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenyisihan1 extends CreateRecord
{
    protected static string $resource = Penyisihan1Resource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
