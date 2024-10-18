<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostChapterResource\Pages;
use App\Filament\Resources\PostChapterResource\RelationManagers;
use App\Models\PostChapter;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostChapterResource extends Resource
{
    protected static ?string $model = PostChapter::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->rows(6)
                    ->columnSpanFull(),
                TextInput::make('number')
                    ->integer(),
                TextInput::make('rate')
                    ->integer(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('post.title'),
                TextColumn::make('title'),
                TextColumn::make('number'),
                TextColumn::make('rate'),
                TextColumn::make('published_at')
                    ->dateTime('Y-m-d, H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPostChapters::route('/'),
            'create' => Pages\CreatePostChapter::route('/create'),
            'edit' => Pages\EditPostChapter::route('/{record}/edit'),
        ];
    }
}
