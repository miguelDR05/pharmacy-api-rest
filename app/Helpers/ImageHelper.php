<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

if (!function_exists('saveImage')) {
    function saveImage(UploadedFile $file, string $folder = 'products'): string
    {
        return $file->store($folder, 'public');
    }
}

if (!function_exists('deleteImage')) {
    function deleteImage(string $path): bool
    {
        return Storage::disk('public')->delete($path);
    }
}

if (!function_exists('getImageUrl')) {
    function getImageUrl(string $path): string
    {
        return Storage::disk('public')->url($path);
    }
}
