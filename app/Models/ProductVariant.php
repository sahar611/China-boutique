<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id','type','size_code','length','width','height','unit',
        'stock','price','sale_price','sku','is_active'
    ];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function label(): string
    {
        if ($this->type === 'standard') return (string) $this->size_code;
        return "{$this->length}×{$this->width}×{$this->height} {$this->unit}";
    }
}
