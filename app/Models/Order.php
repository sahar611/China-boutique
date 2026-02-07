<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code','user_id',
        'customer_name','customer_email','customer_phone','shipping_address',
        'currency_code','currency_rate',
        'subtotal','shipping','discount','total',
        'payment_method','payment_status','status',
        'bank_receipt','placed_at',
    ];
 protected $casts = [
        'placed_at' => 'datetime',
    ];
      public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
