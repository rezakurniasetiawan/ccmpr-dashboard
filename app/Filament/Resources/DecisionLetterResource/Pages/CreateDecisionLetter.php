<?php

namespace App\Filament\Resources\DecisionLetterResource\Pages;

use App\Filament\Resources\DecisionLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDecisionLetter extends CreateRecord
{
    protected static string $resource = DecisionLetterResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['stage_id'] = session('stage_id');
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
