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
            Actions\CreateAction::make(),
            Actions\Action::make('rest all score')
                ->label('Reset All Scores')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function () {
                    // Reset all scores
                    \App\Models\Teams::query()->update(['score_sesi1' => null, 'score_sesi2' => null, 'score_sesi3' => null, 'total_score_before' => null, 'total_score_after' => null]);

                    Notification::make()
                        ->title('All scores have been reset')
                        ->body('All scores have been reset to null.')
                        ->success()
                        ->send();
                }),
        ];
    }
}
