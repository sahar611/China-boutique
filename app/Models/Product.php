<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id','brand_id',
        'name_en','name_ar','slug',
        'description_en','description_ar',
        'price','sale_price',
        'stock','track_stock',
        'sku','is_active','positions','is_featured','home_sort'
    ];

    

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function mainImage(): ?ProductImage
    {
        return $this->images()->where('is_main', 1)->first();
    }
public function mainImageProduct()
{
    return $this->hasOne(ProductImage::class)
                ->where('is_main', 1);
}

    public function getNameAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getDescriptionAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : $this->description_en;
    }

    public function getFinalPriceAttribute(): string
    {
        $price = $this->sale_price ?? $this->price;
        return (string) $price;
    }
    public function reviews()
{
    return $this->hasMany(ProductReview::class);
}

public function visibleReviews()
{
    return $this->hasMany(ProductReview::class)->visible();
}
    protected $casts = [
    'positions'   => 'array',
    'is_featured' => 'boolean',
    'is_active'   => 'boolean',
    'track_stock' => 'boolean',
    'price' => 'decimal:2',
    'sale_price' => 'decimal:2',
    'is_active' => 'boolean',
       
];

}
