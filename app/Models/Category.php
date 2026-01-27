<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public const HOME_POSITIONS = [
    'home_sidebar'       => 'Home Sidebar',
    'header_dropdown'    => 'Header Dropdown',
    'home_top_categories'=> 'Home Top Categories',
    'home_tabs'          => 'Home Tabs',
];

    protected $fillable = [
        'parent_id','name_en','name_ar','slug','image','is_active','sort_order','positions','is_featured','home_sort','home_position'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->orderBy('sort_order');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

   
    public function getNameAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }
    protected $casts = [
    'is_active' => 'boolean',
    'positions' => 'array',
];

}
