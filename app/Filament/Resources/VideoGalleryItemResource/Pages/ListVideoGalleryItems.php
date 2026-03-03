<?php

namespace App\Filament\Resources\VideoGalleryItemResource\Pages;

use App\Filament\Resources\VideoGalleryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVideoGalleryItems extends ListRecords
{
    protected static string $resource = VideoGalleryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
