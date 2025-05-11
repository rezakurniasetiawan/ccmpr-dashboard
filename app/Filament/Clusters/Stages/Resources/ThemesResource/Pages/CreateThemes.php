<?php

namespace App\Filament\Clusters\Stages\Resources\ThemesResource\Pages;

use App\Filament\Clusters\Stages\Resources\ThemesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateThemes extends CreateRecord
{
    protected static string $resource = ThemesResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {

        // Ambil data dari session
        $data['stage_id'] = session('stage_id');
        $data['session_id'] = session('stage_session_id');
        // dd($data);
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
