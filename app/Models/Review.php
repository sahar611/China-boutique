<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
         'booking_id',
        'user_id',
        'workshop_id',
        'provider_id',
        'workshop_rating',
        'provider_rating',
        'comment',
    ];

    public function user()     { return $this->belongsTo(User::class); }
    public function workshop() { return $this->belongsTo(Workshop::class); }
    public function booking()  { return $this->belongsTo(Booking::class); }
    public function provider() { return $this->belongsTo(User::class, 'provider_id'); }
}
