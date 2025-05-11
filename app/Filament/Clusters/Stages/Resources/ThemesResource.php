<?php

namespace App\Filament\Clusters\Stages\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Themes;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\StageSession;
use Filament\Resources\Resource;
use App\Filament\Clusters\Stages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Stages\Resources\ThemesResource\Pages;
use App\Filament\Clusters\Stages\Resources\ThemesResource\RelationManagers;

class ThemesResource extends Resource
{
    protected static ?string $model = Themes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //Select
                // 'stage_id',
                // 'session_id',
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
                Forms\Components\Textarea::make('thema_text')
                    ->rows(10)
                    ->cols(20)
                    ->required()
                    ->label('Tema')
                    ->placeholder('Masukkan Tema')
                    ->columnSpan(['sm' => 2]),
                Forms\Components\Textarea::make('question_text')
                    ->rows(10)
                    ->cols(20)
                    ->required()
                    ->label('Pertanyaan')
                    ->placeholder('Masukkan Pertanyaan')
                    ->columnSpan(['sm' => 2]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Themes::query()
                    ->where('stage_id', session('stage_id'))
                    ->where('session_id', session('stage_session_id'))
                    ->orderBy('created_at', 'desc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('thema_text')
                    ->sortable()
                    ->label('Tema'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            'aswers' => RelationManagers\AnswersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListThemes::route('/'),
            'create' => Pages\CreateThemes::route('/create'),
            'edit' => Pages\EditThemes::route('/{record}/edit'),
        ];
    }
}
