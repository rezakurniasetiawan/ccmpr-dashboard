<?php

namespace App\Filament\Resources\DecisionLetterResource\Pages;

use App\Filament\Resources\DecisionLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDecisionLetter extends EditRecord
{
    protected static string $resource = DecisionLetterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
