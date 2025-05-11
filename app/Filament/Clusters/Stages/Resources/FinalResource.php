<?php

namespace App\Filament\Clusters\Stages\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Final;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\StageSession;
use Filament\Resources\Resource;
use App\Filament\Clusters\Stages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Stages\Resources\FinalResource\Pages;
use App\Filament\Clusters\Stages\Resources\FinalResource\RelationManagers;

class FinalResource extends Resource
{
    protected static ?string $model = StageSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Stages::class;

    public static function getNavigationLabel(): string
    {
        $data =  StageSession::join('stages', 'stage_id', '=', 'stages.id')
            ->where('stages.kode', 'F')
            ->first();
        return  $data->name;
    }

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Stage Name')
                    ->placeholder('Penyisihan 1'),
                Forms\Components\Select::make('stage_id')
                    ->relationship('stage', 'name')
                    ->required()
                    ->label('Stage'),
            ])->columns([
                'sm' => 2,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->query(StageSession::join('stages', 'stage_id', '=', 'stages.id')
                ->where('stages.kode', 'F')
                ->select('stage_sessions.*'))
            ->columns([
                Tables\Columns\TextColumn::make('stage.name')
                    ->sortable()
                    ->label('Stage Name'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->label('Sesion Name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('themes')
                    ->button()
                    ->icon('heroicon-o-arrow-right')
                    ->visible(fn($record) => preg_replace('/\D/', '', $record->name) === '1')
                    ->label('Lanjutan')
                    ->url(fn($record) => route('filament.dashboard.resources.themes.index', [
                        'stage_id' => $record->stage_id,
                        'sesi' => preg_replace('/\D/', '', $record->name),
                        'stage_session_id' => $record->id,
                    ]))
                    ->color('success'),
                Tables\Actions\Action::make('statement')
                    ->button()
                    ->icon('heroicon-o-arrow-right')
                    ->visible(fn($record) => preg_replace('/\D/', '', $record->name) === '2')
                    ->label('Lanjutan')
                    ->url(fn($record) => route('filament.dashboard.resources.statements.index', [
                        'stage_id' => $record->stage_id,
                        'sesi' => preg_replace('/\D/', '', $record->name),
                        'stage_session_id' => $record->id,
                    ]))
                    ->color('info'),
                Tables\Actions\Action::make('question_answer')
                    ->button()
                    ->icon('heroicon-o-arrow-right')
                    ->visible(fn($record) => preg_replace('/\D/', '', $record->name) === '3')
                    ->label('Lanjutan')
                    ->url(fn($record) => route('filament.dashboard.resources.questions-answers.index', [
                        'stage_id' => $record->stage_id,
                        'sesi' => preg_replace('/\D/', '', $record->name),
                        'stage_session_id' => $record->id,
                    ]))
                    ->color('danger'),
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
            'index' => Pages\ListFinals::route('/'),
        ];
    }
}
