<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditMember extends EditRecord
{
    protected static string $resource = MemberResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // pertahankan slug lama bila ada, jika kosong auto-generate
        if (empty($data['slug']) && isset($this->record->slug)) {
            $data['slug'] = $this->record->slug;
        }
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $data;
    }
}
