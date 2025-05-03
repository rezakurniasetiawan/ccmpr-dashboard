<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageSession extends Model
{
    protected $fillable = [
        'stage_id',
        'name',
    ];

    public function stage()
    {
        return $this->belongsTo(Stages::class);
    }
}
