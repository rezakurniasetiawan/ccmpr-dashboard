<?php

namespace App\Filament\Resources\GamePlay2Resource\Pages;

use App\Filament\Resources\GamePlay2Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGamePlay2 extends EditRecord
{
    protected static string $resource = GamePlay2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
