<?php

namespace App\Filament\Clusters\Stages\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Penyisihan3;
use App\Models\StageSession;
use Filament\Resources\Resource;
use App\Filament\Clusters\Stages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Stages\Resources\Penyisihan3Resource\Pages;
use App\Filament\Clusters\Stages\Resources\Penyisihan3Resource\RelationManagers;

class Penyisihan3Resource extends Resource
{
    protected static ?string $model = StageSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Stages::class;

    protected static ?string $navigationLabel = 'Penyisihan 3';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
                    ->label('Penyisihan 3 Name'),
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
            'index' => Pages\ListPenyisihan3s::route('/'),
            'create' => Pages\CreatePenyisihan3::route('/create'),
            'edit' => Pages\EditPenyisihan3::route('/{record}/edit'),
        ];
    }
}
