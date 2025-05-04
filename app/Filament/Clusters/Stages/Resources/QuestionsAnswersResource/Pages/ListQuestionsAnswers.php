<?php

namespace App\Filament\Clusters\Stages\Resources\QuestionsAnswersResource\Pages;

use App\Filament\Clusters\Stages\Resources\QuestionsAnswersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionsAnswers extends ListRecords
{
    protected static string $resource = QuestionsAnswersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function mount(): void
    {
        $stageSessionId = request()->get('stage_session_id');
        $stageId = request()->get('stage_id');
        $sesi = request()->get('sesi');

        if ($stageSessionId) {
            session()->put('stage_session_id', $stageSessionId);
        }

        if ($stageId) {
            session()->put('stage_id', $stageId);
        }

        if ($sesi) {
            session()->put('sesi', $sesi);
        }
    }
}
