<?php

namespace App\Filament\Clusters\Stages\Resources\ThemesResource\Pages;

use App\Filament\Clusters\Stages\Resources\ThemesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditThemes extends EditRecord
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
            Actions\DeleteAction::make(),
        ];
    }

    public function mount($record): void
    {
        parent::mount($record);

        // Simpan ID ke dalam session
        session(['theme_id' => $record]);
    }
}
