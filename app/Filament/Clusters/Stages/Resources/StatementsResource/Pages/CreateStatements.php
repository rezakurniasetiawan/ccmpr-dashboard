<?php

namespace App\Filament\Clusters\Stages\Resources\StatementsResource\Pages;

use App\Filament\Clusters\Stages\Resources\StatementsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatements extends CreateRecord
{
    protected static string $resource = StatementsResource::class;

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
