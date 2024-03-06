<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Books extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 0;

    protected static ?string $slug = 'books';
}
