<?php

namespace App\Filament\Clusters\Stages\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Penyisihan2;
use App\Models\StageSession;
use Filament\Resources\Resource;
use App\Filament\Clusters\Stages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Stages\Resources\Penyisihan2Resource\Pages;
use App\Filament\Clusters\Stages\Resources\Penyisihan2Resource\RelationManagers;

class Penyisihan2Resource extends Resource
{
    protected static ?string $model = StageSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Stages::class;

    protected static ?string $navigationLabel = 'Penyisihan 2';

    protected static ?int $navigationSort = 3;

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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(StageSession::join('stages', 'stage_id', '=', 'stages.id')
                ->where('stages.name', 'Penyisihan 2')
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
                    ->label('Penyisihan 2 Name'),
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
            'index' => Pages\ListPenyisihan2s::route('/'),
            'create' => Pages\CreatePenyisihan2::route('/create'),
            'edit' => Pages\EditPenyisihan2::route('/{record}/edit'),
        ];
    }
}
