<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Reusable trait for all admin controllers that handle file/image uploads.
 * Centralises upload logic — adding a new controller just requires `use HandlesFileUploads`.
 */
trait HandlesFileUploads
{
    /**
     * Upload a single file and return the stored relative path.
     * Automatically deletes the old file if provided.
     */
    protected function uploadFile(Request $request, string $field, string $folder, ?string $oldPath = null): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        return $request->file($field)->store("uploads/{$folder}", 'public');
    }

    /**
     * Upload multiple files and return an array of stored relative paths.
     * Automatically deletes old files if provided.
     */
    protected function uploadMultipleFiles(Request $request, string $field, string $folder, array $oldPaths = []): array
    {
        if (!$request->hasFile($field)) {
            return [];
        }

        foreach ($oldPaths as $path) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
        }

        $paths = [];
        foreach ($request->file($field) as $file) {
            $paths[] = $file->store("uploads/{$folder}", 'public');
        }

        return $paths;
    }

    /**
     * Safely delete a single stored file.
     */
    protected function deleteFile(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Convert a newline-separated textarea string to a clean PHP array.
     * Used for JSON array fields (items, hero_points, experience_highlights, etc.)
     */
    protected function textToArray(?string $text): array
    {
        if (empty($text)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode("\n", $text))));
    }

    /**
     * Convert a PHP array back to a newline-separated string for textarea display.
     */
    protected function arrayToText(mixed $arr): string
    {
        if (empty($arr)) {
            return '';
        }

        if (is_string($arr)) {
            $arr = json_decode($arr, true) ?? [];
        }

        return implode("\n", $arr);
    }
}
