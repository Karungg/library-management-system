<?php

namespace App\Filament\Widgets;

use App\Models\Author;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\Member;
use App\Models\Publisher;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Authors Listed', Author::count())
                ->icon('heroicon-m-pencil-square')
                ->url('books/authors'),
            Stat::make('Publishers Listed', Publisher::count())
                ->icon('heroicon-m-building-library')
                ->url('books/publishers'),
            Stat::make('Categories Listed', Category::count())
                ->icon('heroicon-m-tag')
                ->url('books/categories'),
            Stat::make('Books Listed', Book::count())
                ->icon('heroicon-m-book-open')
                ->url('books/books'),
            Stat::make('Members Listed', Member::count())
                ->icon('heroicon-m-user')
                ->url('members'),
            Stat::make('Borrows Listed', Borrow::count())
                ->icon('heroicon-m-shopping-cart')
                ->url('borrows'),
        ];
    }
}
