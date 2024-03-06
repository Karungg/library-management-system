<?php

namespace App\Filament\Clusters\Books\Resources\PublisherResource\Pages;

use App\Filament\Clusters\Books\Resources\PublisherResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePublisher extends CreateRecord
{
    protected static string $resource = PublisherResource::class;
}
