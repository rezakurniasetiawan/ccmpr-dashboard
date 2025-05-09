<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //    $table->string('name');
    //     $table->string('email')->unique();
    //     $table->string('username')->unique();
    //     $table->string('password');
    //     $table->string('role');

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
    ];

    
}
