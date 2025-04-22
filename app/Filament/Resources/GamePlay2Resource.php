<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\GamePlay2;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\GamePlay2Resource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GamePlay2Resource\RelationManagers;

class GamePlay2Resource extends Resource
{
    protected static ?string $model = GamePlay2::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('winner')
                    ->required()
                    ->maxLength(255),
                //select kontra or pro
                Forms\Components\Select::make('pro_kontra')
                    ->options([
                        'pro' => 'Pro',
                        'kontra' => 'Kontra',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('winner')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('pro_kontra')
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
                // update pro_kontra
                Tables\Actions\Action::make('pro_kontra')
                    ->label('Update Pro/Kontra')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Select::make('pro_kontra')
                            ->options([
                                'pro' => 'Pro',
                                'kontra' => 'Kontra',
                            ])
                            ->default(fn(GamePlay2 $record) => $record->pro_kontra ?? 'pro')
                            ->required(),
                    ])
                    ->action(function (GamePlay2 $record, array $data) {
                        $record->update([
                            'pro_kontra' => $data['pro_kontra'],
                        ]);
                        $record->refresh();

                        Notification::make()
                            ->title('Berhasil')
                            ->body('Pro/Kontra telah berhasil diupdate.')
                            ->success()
                            ->send();
                    })
                    ->color('success')
                    ->button()
                    ->icon('heroicon-o-plus'),

                Tables\Actions\Action::make('score')
                    ->label('Update Score')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\TextInput::make('score')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->default(fn(GamePlay2 $record) => $record->score ?? 0),
                    ])
                    ->action(function (GamePlay2 $record, array $data) {
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
            'index' => Pages\ListGamePlay2s::route('/'),
            'create' => Pages\CreateGamePlay2::route('/create'),
            'edit' => Pages\EditGamePlay2::route('/{record}/edit'),
        ];
    }
}
