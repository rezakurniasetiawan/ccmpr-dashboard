<?php

namespace App\Filament\Clusters\Stages\Resources\StatementsResource\Pages;

use App\Filament\Clusters\Stages\Resources\StatementsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatements extends EditRecord
{
    protected static string $resource = StatementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // statements_id
    public function mount($record): void
    {
        parent::mount($record);

        // Simpan ID ke dalam session
        session(['statements_id' => $record]);
    }
}
