<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UsersCode extends Model
{
    use HasFactory;
    protected $table = 'users_codes';
    protected $fillable = ['otp',  'phone',   'user_id', 'status', 'created_at','updated_at'];

}