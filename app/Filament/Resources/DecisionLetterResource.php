<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DecisionLetterResource\Pages;
use App\Filament\Resources\DecisionLetterResource\RelationManagers;
use App\Models\DecisionLetter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DecisionLetterResource extends Resource
{
    protected static ?string $model = DecisionLetter::class;

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
                Forms\Components\RichEditor::make('letter')
                    ->required()
                    ->label('Decision Letter')
                    ->placeholder('Masukkan Decision Letter')
                    ->columnSpan(['sm' => 2])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                DecisionLetter::query()
                    ->where('stage_id', session('stage_id'))
                    ->orderBy('created_at', 'desc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('stage.name')
                    ->label('Stage')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('letter')
                    ->label('Decision Letter')
                    ->html()
                    ->limit(50)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDecisionLetters::route('/'),
            'create' => Pages\CreateDecisionLetter::route('/create'),
            'edit' => Pages\EditDecisionLetter::route('/{record}/edit'),
        ];
    }
}
