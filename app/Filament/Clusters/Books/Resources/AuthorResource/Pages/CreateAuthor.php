<?php

namespace App\Filament\Clusters\Books\Resources\AuthorResource\Pages;

use App\Filament\Clusters\Books\Resources\AuthorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAuthor extends CreateRecord
{
    protected static string $resource = AuthorResource::class;
}
