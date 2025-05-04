<?php

namespace App\Filament\Clusters\Stages\Resources\ThemesResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnswersRelationManager extends RelationManager
{
    protected static string $relationship = 'Answers';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('answer_text')
                    ->required()
                    ->label('Answer Text')
                    ->placeholder('Masukkan Jawaban')
                    ->columnSpan(['sm' => 2]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('answer_text')
            ->columns([
                Tables\Columns\TextColumn::make('answer_text'),
                Tables\Columns\BooleanColumn::make('is_correct')
                    ->label('Terjawab'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('is_correct')
                    ->action(function (array $data, $record) {
                        $record->update(['is_correct' => !$record->is_correct]);
                    })
                    ->visible(fn($record) => $record->is_correct == false)
                    ->label('Tandai Sudah Dijawab')
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->button()
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['is_correct' => !$record->is_correct]);
                    }),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
