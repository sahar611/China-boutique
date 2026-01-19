<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SessionsUser extends Model
{
    use HasFactory;
    protected $table = 'sessions_users';
    protected $fillable = ['gender', 'age', 'region_id', 'latitude',    'longitude',   'phone', 'lang', 'created_at','updated_at'];

}