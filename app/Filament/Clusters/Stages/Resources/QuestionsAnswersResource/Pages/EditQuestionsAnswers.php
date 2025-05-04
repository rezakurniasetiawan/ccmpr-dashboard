<?php

namespace App\Filament\Clusters\Stages\Resources\QuestionsAnswersResource\Pages;

use App\Filament\Clusters\Stages\Resources\QuestionsAnswersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionsAnswers extends EditRecord
{
    protected static string $resource = QuestionsAnswersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
