<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoverResource\Pages;
use App\Filament\Resources\CoverResource\RelationManagers;
use App\Models\Cover;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CoverResource extends Resource
{
    protected static ?string $model = Cover::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto')
                    ->required()->image()->disk('public'),
                Forms\Components\TextInput::make('content1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('content2')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\ImageColumn::make('foto'),
                Tables\Columns\TextColumn::make('content1'),
                Tables\Columns\TextColumn::make('content2'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCovers::route('/'),
            'create' => Pages\CreateCover::route('/create'),
            'edit' => Pages\EditCover::route('/{record}/edit'),
        ];
    }    
}
