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
                ->url('admin/books/authors'),
            Stat::make('Publishers Listed', Publisher::count())
                ->icon('heroicon-m-building-library')
                ->url('admin/books/publishers'),
            Stat::make('Categories Listed', Category::count())
                ->icon('heroicon-m-tag')
                ->url('admin/books/categories'),
            Stat::make('Books Listed', Book::count())
                ->icon('heroicon-m-book-open')
                ->url('admin/books/books'),
            Stat::make('Members Listed', Member::count())
                ->icon('heroicon-m-user')
                ->url('admin/members'),
            Stat::make('Borrows Listed', Borrow::count())
                ->icon('heroicon-m-shopping-cart')
                ->url('admin/borrows'),
        ];
    }
}
