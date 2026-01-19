<?php
namespace App\Support;

use Illuminate\Support\Str;

trait GeneratesUniqueSlug
{
    protected function generateUniqueSlug(string $modelClass, string $base, ?int $ignoreId = null): string
    {
        $slug = Str::slug($base);
        $original = $slug;
        $i = 2;

        while ($modelClass::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $original . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
