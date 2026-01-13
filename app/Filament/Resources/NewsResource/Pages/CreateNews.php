<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $state = $this->form->getState();
        $uploadPath = $state['image_file'] ?? null;
        $uploadPath = is_array($uploadPath) ? ($uploadPath[0] ?? null) : $uploadPath;
        $og = NewsResource::fetchOgMetadata($data['url'] ?? '');

        // Prioritas gambar: upload lokal > URL manual > OG
        if (!empty($uploadPath)) {
            $data['image'] = $uploadPath;
        } elseif (!empty($data['image'])) {
            // sudah diisi URL manual, biarkan
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

        // fallback minimal agar kolom non-null
        if (empty($data['title'])) {
            $data['title'] = $og['title'] ?? parse_url($data['url'], PHP_URL_HOST) ?? 'Berita';
        }
        if (empty($data['excerpt'])) {
            $data['excerpt'] = $og['description'] ?? 'Berita terbaru.';
        }
        if (empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        unset($data['image_file']);

        return $data;
    }
}
