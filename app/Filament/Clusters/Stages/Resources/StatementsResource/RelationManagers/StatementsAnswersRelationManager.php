<?php

namespace App\Filament\Clusters\Stages\Resources\StatementsResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use EightyNine\ExcelImport\Tables\ExcelImportRelationshipAction;

class StatementsAnswersRelationManager extends RelationManager
{
    protected static string $relationship = 'StatementsAnswers';

    public function form(Form $form): Form
    {
        // 'type',
        // 'answer_text',
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->options([
                        'pro' => 'Pro',
                        'kontra' => 'Kontra',
                    ])
                    ->required()
                    ->label('Answer Type')
                    ->placeholder('Pilih Tipe Jawaban')
                    ->reactive() // Make it reactive to trigger updates
                    ->afterStateUpdated(function (callable $set) {
                        $set('answer_text', null); // Reset answer_text when type changes
                    })
                    ->columnSpan(['sm' => 2]),
                Forms\Components\Textarea::make('answer_text')
                    ->required()
                    ->label('Answer Text')
                    ->placeholder('Masukkan Jawaban')
                    ->columnSpan(['sm' => 2])
                    ->hidden(fn(callable $get) => $get('type') === null), // Hide if type is not selected
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('answer_text')
            ->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                return $query->orderByRaw("FIELD(type, 'pro', 'kontra')");
            })
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn($record) => $record->type === 'pro' ? 'success' : 'info')
                    ->label('Answer Type')
                    ->formatStateUsing(fn($state) => $state === 'pro' ? 'Pro' : ($state === 'kontra' ? 'Kontra' : $state))
                    ->description(fn($record) => \Illuminate\Support\Str::limit($record->answer_text, 110)),
                Tables\Columns\BooleanColumn::make('is_correct')
                    ->label('Terjawab'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                ExcelImportRelationshipAction::make()
                    ->color('success')
                    ->use(\App\Imports\StatementsAnswersImport::class)
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
                    // update is_correct 
                    Tables\Actions\BulkAction::make('is_correct')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['is_correct' => !$record->is_correct]);
                            }
                        })
                        ->label('Tandai Sudah Dijawab')
                        ->color('success')
                        ->icon('heroicon-o-check')
                        ->button()
                        ->requiresConfirmation(),
                ]),
            ]);
    }
}
