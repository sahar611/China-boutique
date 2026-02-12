<?php

namespace App\Models;
use Spatie\Permission\Traits\HasRoles;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable ,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';
   protected $fillable = [
    'name','email','password',
    'phone','status','verified','picture','account_type', 'address',
];

 
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function permission()
    { 
        return $this->belongsTo(Listpermission::class, 'permission_id');
    }
    
      public function workshops()
    {
        return $this->hasMany(Workshop::class, 'provider_id');
    }

   
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }
    public function payments()
{
    return $this->hasMany(Payment::class);
}
public function certificates()
{
    return $this->hasMany(ProviderCertificate::class, 'provider_id');
}

public function city()
{
    return $this->belongsTo(City::class, 'city_id');
}
public function favoriteWorkshops()
{
    return $this->belongsToMany(Workshop::class, 'favorites')
        ->withTimestamps();
}
public function receivedReviews()
{
    return $this->hasMany(Review::class, 'provider_id');
}
public function wishlists()
{
    return $this->hasMany(Wishlist::class);
}

public function wishlistProducts()
{
    return $this->belongsToMany(Product::class, 'wishlists')
        ->withTimestamps();
}
public function getDefaultGuardName(): string
{
    return ($this->account_type === 'staff') ? 'admin' : 'web';
}


}
