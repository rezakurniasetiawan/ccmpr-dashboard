<?php

namespace App\Filament\Clusters\Stages\Resources\ThemesResource\Pages;

use Filament\Actions;
use App\Imports\ThemeImport;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Stages\Resources\ThemesResource;

class ListThemes extends ListRecords
{
    protected static string $resource = ThemesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            \EightyNine\ExcelImport\ExcelImportAction::make()
                ->color("success")
                ->use(ThemeImport::class),

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
