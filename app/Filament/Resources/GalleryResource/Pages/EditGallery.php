<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use App\Filament\Resources\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGallery extends EditRecord
{
    protected static string $resource = GalleryResource::class;

    protected function getHeaderActions(): array
    {
        // Hilangkan delete di halaman edit (pakai delete di list)
        return [];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $images = $data['images'] ?? [];
        if (empty($data['image']) && is_array($images) && count($images)) {
            $data['image'] = $images[0];
        }
        return $data;
    }
}
