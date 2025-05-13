<?php

namespace App\Filament\Resources\TeamsResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use App\Filament\Resources\TeamsResource;
use Filament\Resources\Pages\ListRecords;

class ListTeams extends ListRecords
{
    protected static string $resource = TeamsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Actions\Action::make('Back')
                ->label('Back')
                ->color('gray')
                ->url(route('filament.dashboard.stages.resources.stages.index'))
                ->icon('heroicon-m-arrow-left'),
            Actions\Action::make('rest all score')
                ->label('Reset All Scores')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function () {
                    // Reset all scores
                    \App\Models\Teams::query()->update([
                        'score_sesi1' => null,
                        'score_sesi2' => null,
                        'score_sesi3' => null,
                        'total_score_before' => null,
                        'total_score_after' => null,
                        'pro_kontra' => null,
                        'theme_id' => null,
                        'statement_id' => null,
                    ]);

                    // Delete scoreS3Team based on team_id
                    \App\Models\ScoreS3Team::query()->delete();

                    Notification::make()
                        ->title('All scores have been reset')
                        ->body('All scores and related ScoreS3Team records have been reset to null.')
                        ->success()
                        ->send();
                }),
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
