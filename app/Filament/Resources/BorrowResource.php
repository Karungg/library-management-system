<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\BorrowResource\Pages;
use App\Filament\Resources\BorrowResource\RelationManagers;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Setting;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BorrowResource extends Resource
{
    protected static ?string $model = Borrow::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Transaction';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('member_id')
                    ->relationship('member', 'name')
                    ->required(),
                Forms\Components\Select::make('book_id')
                    ->required()
                    ->multiple()
                    ->relationship('books', 'title')
                    ->maxItems(3),
                Forms\Components\DatePicker::make('return_date')
                    ->required()
                    ->minDate(now()),
                Forms\Components\DatePicker::make('return_day')
                    ->minDate(function (Get $get) {
                        return $get('created_at');
                    }),
                Forms\Components\TextInput::make('fine')
                    ->numeric()
                    ->required()
                    ->label('Fine Per Day'),
                Forms\Components\ToggleButtons::make('status')
                    ->required()
                    ->options(StatusEnum::class)
                    ->inline(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Borrow At'),
                Tables\Columns\TextColumn::make('member.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('books.title')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('return_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('return_day')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fine')
                    ->sortable()
                    ->default(0)
                    ->getStateUsing(function (Borrow $record): float {
                        $return_date = Carbon::parse($record->return_date);
                        $return_day = $record->return_day ? Carbon::parse($record->return_day) : null;

                        if ($return_date > $return_day) {
                            return 0;
                        }

                        $diff = $return_day ? $return_date->diffInDays($return_day) : 0;
                        return $diff * $record->fine;
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
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
            'index' => Pages\ListBorrows::route('/'),
            'create' => Pages\CreateBorrow::route('/create'),
            'edit' => Pages\EditBorrow::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
