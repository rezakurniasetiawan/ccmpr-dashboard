<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GamePlayDua extends Model
{
    // $table->string('winner')->nullable();
    // $table->string('pro_kontra')->nullable();
    // $table->integer('score')->default(0);

    protected $fillable = [
        'winner',
        'pro_kontra',
        'score',
    ];
}
