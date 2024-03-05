<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\BookIssueResource\Pages;
use App\Filament\Resources\BookIssueResource\RelationManagers;
use App\Models\BookIssue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookIssueResource extends Resource
{
    protected static ?string $model = BookIssue::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    protected static ?string $navigationGroup = 'Transaction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('member_id')
                    ->relationship('member', 'name')
                    ->required(),
                Forms\Components\Select::make('book_id')
                    ->relationship('book', 'title')
                    ->required(),
                Forms\Components\DatePicker::make('issue_date')
                    ->required(),
                Forms\Components\DatePicker::make('return_date'),
                Forms\Components\Radio::make('status')
                    ->required()
                    ->options(StatusEnum::class),
                Forms\Components\DatePicker::make('return_day'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('member.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('book.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('issue_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('return_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('return_day')
                    ->dateTime()
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListBookIssues::route('/'),
            'create' => Pages\CreateBookIssue::route('/create'),
            'view' => Pages\ViewBookIssue::route('/{record}'),
            'edit' => Pages\EditBookIssue::route('/{record}/edit'),
        ];
    }
}
