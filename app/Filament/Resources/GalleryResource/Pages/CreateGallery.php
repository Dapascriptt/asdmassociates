<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use App\Filament\Resources\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGallery extends CreateRecord
{
    protected static string $resource = GalleryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $images = $data['images'] ?? [];
        if (empty($data['image']) && is_array($images) && count($images)) {
            $data['image'] = $images[0];
        }
        return $data;
    }
}
