<?php

namespace App\Filament\Resources\DecisionLetterResource\Pages;

use App\Filament\Resources\DecisionLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDecisionLetters extends ListRecords
{
    protected static string $resource = DecisionLetterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->hidden(function () {
                    $count = \App\Models\DecisionLetter::where('stage_id', session('stage_id'))->count();
                    return $count > 0;
                })
                ->label('Create Decision Letter')


        ];
    }

    public function mount(): void
    {
        $stageId = request()->get('stage_id');

        if ($stageId) {
            session()->put('stage_id', $stageId);
        }
    }
}
