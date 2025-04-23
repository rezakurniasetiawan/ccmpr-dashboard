<?php

namespace App\Filament\Resources\GamePlay1Resource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\GamePlay1Resource;

class ListGamePlay1s extends ListRecords
{
    protected static string $resource = GamePlay1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Actions\Action::make('reset_all_score')
                ->label('Reset All Score')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function () {
                    // Reset all scores
                    \App\Models\GamePlay1::query()->update(['score' => 0]);

                    Notification::make()
                        ->title('All scores have been reset')
                        ->success()
                        ->send();
                }),
        ];
    }
}
