<?php

namespace App\Filament\Clusters\Books\Resources\BookResource\Pages;

use App\Filament\Clusters\Books\Resources\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;
}
