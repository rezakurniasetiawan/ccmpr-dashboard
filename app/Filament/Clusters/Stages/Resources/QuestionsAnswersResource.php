<?php

namespace App\Filament\Clusters\Stages\Resources;

use App\Filament\Clusters\Stages;
use App\Filament\Clusters\Stages\Resources\QuestionsAnswersResource\Pages;
use App\Filament\Clusters\Stages\Resources\QuestionsAnswersResource\RelationManagers;
use App\Models\QuestionsAnswers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionsAnswersResource extends Resource
{
    protected static ?string $model = QuestionsAnswers::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('stage_id')
                    ->relationship('stage', 'name')
                    ->preload()
                    ->default(
                        fn($record) => $record->stage_id ?? session('stage_id')
                    )
                    ->reactive()
                    ->label('Stage')
                    ->disabled()
                    ->placeholder('Pilih Stage'),

                Forms\Components\Select::make('session_id')
                    ->relationship('session', 'name')
                    ->required()
                    ->disabled()
                    ->preload()
                    ->default(
                        fn($record) => $record->session_id ?? session('stage_session_id')
                    )
                    ->label('Stage Session')
                    ->placeholder('Pilih Stage Session'),
                Forms\Components\TextInput::make('question_text')
                    ->required()
                    ->label('Pertanyaan')
                    ->placeholder('Masukkan Pertanyaan')
                    ->columnSpan(['sm' => 2]),
                Forms\Components\Textarea::make('answer_text')
                    ->rows(10)
                    ->cols(20)
                    ->required()
                    ->label('Jawaban')
                    ->placeholder('Masukkan Jawaban')
                    ->columnSpan(['sm' => 2]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                QuestionsAnswers::query()
                    ->where('stage_id', session('stage_id'))
                    ->where('session_id', session('stage_session_id'))
                    ->orderBy('created_at', 'desc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('question_text')
                    ->sortable()
                    ->label('Pertanyaan')
                    ->description(fn($record) => 'Jawaban: ' . \Illuminate\Support\Str::limit($record->answer_text, 110)),
                Tables\Columns\BooleanColumn::make('is_correct')
                    ->label('Terjawab'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestionsAnswers::route('/'),
            'create' => Pages\CreateQuestionsAnswers::route('/create'),
            'edit' => Pages\EditQuestionsAnswers::route('/{record}/edit'),
        ];
    }
}
