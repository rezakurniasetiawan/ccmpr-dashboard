<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{

    protected $fillable = [
        'theme_id',
        'question_text',
    ];
    public function theme()
    {
        return $this->belongsTo(Themes::class);
    }
}
