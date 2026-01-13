<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected function getHeaderActions(): array
    {
        // Hilangkan delete di halaman edit (pakai delete di list saja)
        return [];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $state = $this->form->getState();
        $uploadPath = $state['image_file'] ?? null;
        $uploadPath = is_array($uploadPath) ? ($uploadPath[0] ?? null) : $uploadPath;

        // Jika kolom image berisi path lokal saat mulai edit, manfaatkan sebagai default upload
        if (!$uploadPath && !empty($data['image']) && !Str::startsWith($data['image'], ['http://', 'https://'])) {
            $uploadPath = $data['image'];
        }

        $og = [];
        if (!empty($data['url'])) {
            $og = NewsResource::fetchOgMetadata($data['url']);
        }

        if (!empty($uploadPath)) {
            $data['image'] = $uploadPath;
        } elseif (!empty($data['image'])) {
            // keep manual url
        } else {
            $data['image'] = $og['image'] ?? null;
        }

        if (!empty($data['image']) && Str::startsWith($data['image'], 'livewire-file:')) {
            $data['image'] = null;
        }

        $data['title'] = $data['title'] ?? ($og['title'] ?? parse_url($data['url'], PHP_URL_HOST) ?? 'Berita');
        $data['excerpt'] = $data['excerpt'] ?? (isset($og['description']) ? Str::limit($og['description'], 200) : 'Berita terbaru.');
        $data['site_name'] = $data['site_name'] ?? ($og['site_name'] ?? parse_url($data['url'], PHP_URL_HOST));

        if (empty($data['published_at']) && !empty($og['published_at'])) {
            try {
                $data['published_at'] = Carbon::parse($og['published_at']);
            } catch (\Throwable $e) {
                // biarkan kosong jika parse gagal
            }
        }
        if (empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        unset($data['image_file']);

        return $data;
    }
}
