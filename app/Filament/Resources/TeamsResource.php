<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Teams;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ScoreS3Team;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TeamsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TeamsResource\RelationManagers;

class TeamsResource extends Resource
{
    protected static ?string $model = Teams::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static ?string $label = 'Team -';

    public static function getLabel(): string
    {
        $stageId = session('stage_id', 'default_stage');
        $stageName = \App\Models\Stages::find($stageId)->name ?? 'Unknown Stage';
        return self::$label . ' ' . $stageName;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('school_name')
                    ->label('School Name')
                    ->required()
                    ->maxLength(255)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Teams::query()
                    ->where('stage_id', session('stage_id'))
                    ->orderBy('created_at', 'desc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('team_name')
                    ->label('Team')
                    ->description(fn($record) => $record->school_name),


                Tables\Columns\TextColumn::make('score_sesi1')
                    ->badge()
                    ->color('info')
                    ->label('Score S1'),
                Tables\Columns\TextColumn::make('score_sesi2')
                    ->badge()
                    ->color('info')
                    ->label('Score S2'),
                Tables\Columns\TextColumn::make('score_sesi3')
                    ->badge()
                    ->color('info')
                    ->description(fn($record) => ScoreS3Team::where('team_id', $record->id)->pluck('score')->implode(', '))
                    ->label('Score S3'),
                Tables\Columns\TextColumn::make('total_score_before')
                    ->badge()
                    ->color('danger')
                    ->label('Total Score'),
                Tables\Columns\TextColumn::make('total_score_after')
                    ->badge()
                    ->color('success')
                    ->label('Score Setelah Pembobotan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('S1')
                    ->icon('heroicon-o-pencil')
                    ->label('S1')
                    ->button()
                    ->form([
                        Section::make('Score Sesi 1')
                            ->description('Pilih Score Sesi 1')
                            ->schema([
                                Radio::make('score')
                                    ->label('Pilih Score')
                                    ->options([
                                        '0' => '0',
                                        '10' => '10',
                                        '20' => '20',
                                        '30' => '30',
                                        '40' => '40',
                                        '50' => '50',
                                        '60' => '60',
                                        '70' => '70',
                                        '80' => '80',
                                        '90' => '90',
                                        '100' => '100',
                                    ])
                                    ->inline(true)
                                    ->columns(6)
                                    ->default(fn($record) => $record->score_sesi1), // Set default value
                            ]),
                    ])
                    ->action(function ($record, $data) {
                        $record->update(['score_sesi1' => $data['score']]);

                        // Update total_score_before if all scores are not null
                        $scoreSesi1 = $record->score_sesi1 ?? 0;
                        $scoreSesi2 = $record->score_sesi2 ?? 0;
                        $scoreSesi3 = $record->score_sesi3 ?? 0;

                        $totalScoreBefore = $scoreSesi1 + $scoreSesi2 + $scoreSesi3;
                        $record->update(['total_score_before' => $totalScoreBefore]);

                        Notification::make()
                            ->title('Score Sesi 1 updated successfully!')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('S2')
                    ->icon('heroicon-o-pencil')
                    ->label('S2')
                    ->button()
                    ->form([
                        Section::make('Score Sesi 2')
                            ->description('Pilih Score Sesi 2')
                            ->schema([
                                Radio::make('score')
                                    ->label('Pilih Score')
                                    ->options([
                                        '0' => '0',
                                        '5' => '5',
                                        '10' => '10',
                                        '15' => '15',
                                        '20' => '20',
                                        '25' => '25',
                                    ])
                                    ->inline(true)
                                    ->columns(6)
                                    ->default(fn($record) => $record->score_sesi2), // Set default value
                            ]),
                    ])
                    ->action(function ($record, $data) {
                        $record->update(['score_sesi2' => $data['score']]);

                        // Update total_score_before if all scores are not null
                        $scoreSesi1 = $record->score_sesi1 ?? 0;
                        $scoreSesi2 = $record->score_sesi2 ?? 0;
                        $scoreSesi3 = $record->score_sesi3 ?? 0;

                        $totalScoreBefore = $scoreSesi1 + $scoreSesi2 + $scoreSesi3;
                        $record->update(['total_score_before' => $totalScoreBefore]);

                        Notification::make()
                            ->title('Score Sesi 2 updated successfully!')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('S3')
                    ->icon('heroicon-o-pencil')
                    ->label('S3')
                    ->button()
                    ->form([
                        Section::make('Score Sesi 3')
                            ->description('Pilih Score Sesi 3')
                            ->schema([
                                Radio::make('score')
                                    ->label('Pilih Score')
                                    ->options([
                                        '-5' => '-5',
                                        '0' => '0',
                                        '10' => '10',
                                    ])
                                    ->inline(true)
                                    ->columns(6)
                            ]),
                    ])
                    ->action(function ($record, $data) {

                        // create new ScoreS3Team record
                        // Calculate total score from ScoreS3Team based on team_id
                        // Create a new ScoreS3Team record first
                        $lastScoreS3Team = ScoreS3Team::where('team_id', $record->id)
                            ->orderBy('urutan', 'desc')
                            ->first();

                        $newUrutan = $lastScoreS3Team ? $lastScoreS3Team->urutan + 1 : 1;

                        $scoreS3Team = new ScoreS3Team();
                        $scoreS3Team->team_id = $record->id;
                        $scoreS3Team->score = $data['score'];
                        $scoreS3Team->urutan = $newUrutan; // Set urutan based on the last record
                        $scoreS3Team->save();

                        // Calculate the total score from ScoreS3Team based on team_id
                        $totalScoreS3 = ScoreS3Team::where('team_id', $record->id)->sum('score');

                        // Update score_sesi3 with the calculated total score
                        $record->update(['score_sesi3' => $totalScoreS3]);

                        // Update total_score_before by recalculating all scores
                        $scoreSesi1 = $record->score_sesi1 ?? 0;
                        $scoreSesi2 = $record->score_sesi2 ?? 0;
                        $scoreSesi3 = $totalScoreS3;

                        $totalScoreBefore = $scoreSesi1 + $scoreSesi2 + $scoreSesi3;
                        $record->update(['total_score_before' => $totalScoreBefore]);

                        Notification::make()
                            ->title('Score Sesi 3 updated successfully!')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('Bobot')
                    ->icon('heroicon-o-calculator')
                    ->label('Calculate')
                    ->color('danger')
                    ->button()
                    ->disabled(fn($record) => is_null($record->score_sesi1) || is_null($record->score_sesi2) || is_null($record->score_sesi3))
                    ->action(function ($record) {
                        $scoreSesi1 = $record->score_sesi1 ?? 0;
                        $scoreSesi2 = $record->score_sesi2 ?? 0;
                        $scoreSesi3 = $record->score_sesi3 ?? 0;

                        // Ensure no negative scores are used in the calculation
                        $scoreSesi1 = max(0, $scoreSesi1);
                        $scoreSesi2 = max(0, $scoreSesi2);
                        $scoreSesi3 = max(0, $scoreSesi3);

                        // Calculate weighted total score
                        $totalScoreAfter = ($scoreSesi1 * 0.2) + ($scoreSesi2 * 0.3) + ($scoreSesi3 * 0.5);
                        $record->update(['total_score_after' => $totalScoreAfter]);

                        Notification::make()
                            ->title('Weighted score calculated successfully!')
                            ->success()
                            ->send();
                    })
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeams::route('/create'),
            'edit' => Pages\EditTeams::route('/{record}/edit'),
        ];
    }
}
