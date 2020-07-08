<?php

namespace App\EloquentModel;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = [
        'id','name', 'email', 'password', 'password_bcrypt'
    ];
}
