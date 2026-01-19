<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'code','name','symbol','decimal_places',
        'is_default','is_active','sort_order','rate'
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'is_active'  => 'boolean',
        'decimal_places' => 'integer',
        'sort_order' => 'integer',
        'rate' => 'decimal:8',
    ];

    public function scopeActive($q)
    {
        return $q->where('is_active', 1);
    }

    public function scopeDefault($q)
    {
        return $q->where('is_default', 1);
    }
}
