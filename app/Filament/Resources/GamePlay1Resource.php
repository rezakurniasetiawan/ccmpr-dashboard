<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\gamePlay1;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\GamePlay1Resource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GamePlay1Resource\RelationManagers;

class GamePlay1Resource extends Resource
{
    protected static ?string $model = gamePlay1::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('winner')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('score')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('winner')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('score')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('score')
                    ->label('Update Score')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\TextInput::make('score')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->default(fn(gamePlay1 $record) => $record->score ?? 0),
                    ])
                    ->action(function (gamePlay1 $record, array $data) {
                        $record->update([
                            'score' => $data['score'],
                        ]);
                        $record->refresh();

                        Notification::make()
                            ->title('Berhasil')
                            ->body('Score telah berhasil diupdate.')
                            ->success()
                            ->send();
                    })
                    ->color('success')
                    ->button()
                    ->icon('heroicon-o-plus'),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGamePlay1s::route('/'),
            'create' => Pages\CreateGamePlay1::route('/create'),
            'edit' => Pages\EditGamePlay1::route('/{record}/edit'),
        ];
    }
}
