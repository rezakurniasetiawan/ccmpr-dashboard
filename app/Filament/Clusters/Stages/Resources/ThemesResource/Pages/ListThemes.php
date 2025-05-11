<?php

namespace App\Filament\Clusters\Stages\Resources\ThemesResource\Pages;

use App\Filament\Clusters\Stages\Resources\ThemesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListThemes extends ListRecords
{
    protected static string $resource = ThemesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\Action::make('Back')
            //     ->label('Back')
            //     ->color('gray')
            //     ->url(url()->previous())
            //     ->icon('heroicon-m-arrow-left'),
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
