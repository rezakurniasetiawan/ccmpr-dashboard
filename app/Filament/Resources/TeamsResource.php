<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Teams;
use Filament\Forms\Form;
use Filament\Tables\Table;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section::make('Team')
                //     ->description('Team Information')
                //     ->schema([
                //         Radio::make('score')
                //             ->label('Pilih Score')
                //             ->options([
                //                 '0' => '0',
                //                 '10' => '10',
                //                 '20' => '20',
                //                 '30' => '30',
                //                 '40' => '40',
                //                 '50' => '50',
                //                 '60' => '60',
                //                 '70' => '70',
                //                 '80' => '80',
                //                 '90' => '90',
                //                 '100' => '100',
                //             ])
                //             ->inline(true)
                //             ->columns(6)
                //     ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                    ->label('Score S3'),
                Tables\Columns\TextColumn::make('total_score_before')
                    ->badge()
                    ->color('danger')
                    ->label('Total Score Sebelum'),
                Tables\Columns\TextColumn::make('total_score_after')
                    ->badge()
                    ->color('success')
                    ->label('Total Score Setelah'),
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
                                    ->default(fn($record) => $record->score_sesi3), // Set default value
                            ]),
                    ])
                    ->action(function ($record, $data) {
                        $record->update(['score_sesi3' => $data['score']]);

                        // Update total_score_before if all scores are not null
                        $scoreSesi1 = $record->score_sesi1 ?? 0;
                        $scoreSesi2 = $record->score_sesi2 ?? 0;
                        $scoreSesi3 = $record->score_sesi3 ?? 0;

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
