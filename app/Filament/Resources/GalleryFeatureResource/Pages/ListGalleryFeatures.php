<?php

namespace App\Filament\Resources\GalleryFeatureResource\Pages;

use App\Filament\Resources\GalleryFeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleryFeatures extends ListRecords
{
    protected static string $resource = GalleryFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
