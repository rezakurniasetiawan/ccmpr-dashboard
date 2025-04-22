<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gamePlaySatu extends Model
{
    // $table->string('winner')->nullable();
    // $table->integer('score')->default(0);

    protected $fillable = [
        'winner',
        'score',
    ];
}
