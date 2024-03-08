<?php

namespace App\Filament\Clusters\Books\Resources;

use App\Filament\Clusters\Books;
use App\Filament\Clusters\Books\Resources\BookResource\Pages;
use App\Filament\Clusters\Books\Resources\BookResource\RelationManagers;
use App\Models\Book;
use App\Models\Scopes\ActiveScope;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $cluster = Books::class;

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'title')
                    ->required(),
                Forms\Components\Select::make('author_id')
                    ->relationship('author', 'name')
                    ->required(),
                Forms\Components\Select::make('publisher_id')
                    ->required()
                    ->relationship('publisher', 'name'),
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('publisher.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([ActiveScope::class]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
