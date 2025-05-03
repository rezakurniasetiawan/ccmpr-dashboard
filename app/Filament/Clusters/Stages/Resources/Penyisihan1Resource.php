<?php

namespace App\Filament\Clusters\Stages\Resources;

use App\Filament\Clusters\Stages;
use App\Filament\Clusters\Stages\Resources\Penyisihan1Resource\Pages;
use App\Filament\Clusters\Stages\Resources\Penyisihan1Resource\RelationManagers;
use App\Models\Penyisihan1;
use App\Models\StageSession;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class Penyisihan1Resource extends Resource
{
    protected static ?string $model = StageSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Stages::class;

    protected static ?string $navigationLabel = 'Penyisihan 1';

    protected static ?int $navigationSort = 2;

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
            ->query(StageSession::join('stages', 'stage_id', '=', 'stages.id')
                ->where('stages.name', 'Penyisihan 1')
                ->select('stage_sessions.*'))
            ->columns([
                Tables\Columns\TextColumn::make('stage.name')
                    ->sortable()
                    ->searchable()
                    ->label('Stage Name'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->label('Penyisihan 1 Name'),
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
            'index' => Pages\ListPenyisihan1s::route('/'),
            'create' => Pages\CreatePenyisihan1::route('/create'),
            'edit' => Pages\EditPenyisihan1::route('/{record}/edit'),
        ];
    }
}
