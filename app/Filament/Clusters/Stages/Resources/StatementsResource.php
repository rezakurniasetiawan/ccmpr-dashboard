<?php

namespace App\Filament\Clusters\Stages\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Statements;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\Stages;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Stages\Resources\StatementsResource\Pages;
use App\Filament\Clusters\Stages\Resources\StatementsResource\RelationManagers;

class StatementsResource extends Resource
{
    protected static ?string $model = Statements::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        // 'box_name',
        // 'statement_text',
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
                Forms\Components\TextInput::make('box_name')
                    ->required()
                    ->label('Box Name')
                    ->placeholder('Masukkan Box Name')
                    ->columnSpan(['sm' => 2]),
                Forms\Components\Textarea::make('statement_text')
                    ->rows(10)
                    ->cols(20)
                    ->required()
                    ->label('Pernyataan')
                    ->placeholder('Masukkan Pernyataan')
                    ->columnSpan(['sm' => 2]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Statements::query()
                    ->where('stage_id', session('stage_id'))
                    ->where('session_id', session('stage_session_id'))
                    ->orderBy('created_at', 'desc')
            )
            ->columns([
                Stack::make([
                    Tables\Columns\TextColumn::make('box_name')
                        ->sortable()
                        ->badge()
                        ->color('info')
                        ->label('Box Name'),
                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->button()
                    ->icon('heroicon-o-arrow-right')
                    ->label('Lanjutkan')
                    ->color('primary')
                    ->beforeFormFilled(function ($record) {
                        session(['statements_id' => $record->id]);
                    }),
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
            'StatementsAnswers' => RelationManagers\StatementsAnswersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStatements::route('/'),
            'create' => Pages\CreateStatements::route('/create'),
            'edit' => Pages\EditStatements::route('/{record}/edit'),
        ];
    }
}
