<?php
namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait UploadsToPublic
{
    protected function uploadFile(UploadedFile $file, string $folder): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = "uploads/{$folder}";

        $file->move(public_path($path), $filename);

        return "{$path}/{$filename}";
    }

    protected function deleteFile(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
