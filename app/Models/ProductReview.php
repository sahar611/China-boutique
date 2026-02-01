<?php
// app/Models/ProductReview.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = [
        'product_id','user_id','name','email','rating','comment',
        'is_approved','is_visible','approved_at','ip','user_agent'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_visible'  => 'boolean',
        'approved_at' => 'datetime',
        'rating'      => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeVisible($q)
    {
        return $q->where('is_approved', true)->where('is_visible', true);
    }
}
