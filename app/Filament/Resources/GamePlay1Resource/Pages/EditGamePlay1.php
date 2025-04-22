<?php

namespace App\Filament\Resources\GamePlay1Resource\Pages;

use App\Filament\Resources\GamePlay1Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGamePlay1 extends EditRecord
{
    protected static string $resource = GamePlay1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
