<?php

namespace App\Filament\Clusters\Stages\Resources;

use App\Filament\Clusters\Stages as StagesCluster;
use App\Filament\Clusters\Stages\Resources\StagesResource\Pages;
use App\Filament\Clusters\Stages\Resources\StagesResource\RelationManagers;
use App\Models\Stages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StagesResource extends Resource
{
    protected static ?string $model = Stages::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = StagesCluster::class;

    protected static ?string $navigationLabel = 'Manage Stages';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Stage Name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('province.name')
                    ->sortable()
                    ->searchable()
                    ->label('Province Name'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->badge()
                    ->color(fn($record) => $record->name === 'Final' ? 'info' : 'danger')
                    ->searchable()
                    ->label('Stage Name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Created At'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Updated At'),
            ])->filters([
                //
            ])->actions([
                //
            ])->bulkActions([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
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
            'index' => Pages\ListStages::route('/'),
            // 'create' => Pages\CreateStages::route('/create'),
            // 'edit' => Pages\EditStages::route('/{record}/edit'),
        ];
    }
}
