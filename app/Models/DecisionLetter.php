<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DecisionLetter extends Model
{

    protected $fillable = [
        'stage_id',
        'letter',
    ];

    public function stage()
    {
        return $this->belongsTo(Stages::class);
    }
}
