<?php

namespace App\Filament\Resources\GamePlay2Resource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\GamePlay2Resource;

class ListGamePlay2s extends ListRecords
{
    protected static string $resource = GamePlay2Resource::class;

    protected function getHeaderActions(): array
    {
        return [

            // actionn reset score
            Actions\Action::make('reset_all_and_pro_kontra')
                ->label('Reset All and Pro Kontra')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function () {
                    // Reset all scores
                    \App\Models\GamePlay2::query()->update(['score' => 0, 'pro_kontra' => null]);

                    Notification::make()
                        ->title('All scores have been reset and Pro Kontra action executed')
                        ->success()
                        ->send();
                })
        ];
    }
}
