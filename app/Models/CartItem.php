<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CartItem extends Model
{
    protected $fillable = ['cart_id','product_id','qty','unit_price','unit_sale_price','variant_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFinalUnitAttribute(): float
    {
        $sale = (float)($this->unit_sale_price ?? 0);
        return ($sale > 0 && $sale < (float)$this->unit_price) ? $sale : (float)$this->unit_price;
    }
    public function variant()
{
    return $this->belongsTo(ProductVariant::class, 'variant_id');
}
}
