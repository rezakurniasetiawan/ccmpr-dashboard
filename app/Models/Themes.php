<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    // $table->foreignId('stage_id')->constrained()->onDelete('cascade');
    // $table->foreignId('session_id')->constrained('stage_sessions')->onDelete('cascade');
    // $table->text('thema_text');
    // $table->text('question_text');


    protected $fillable = [
        'stage_id',
        'session_id',
        'thema_text',
        'question_text',
    ];

    public function stage()
    {
        return $this->belongsTo(Stages::class);
    }

    public function session()
    {
        return $this->belongsTo(StageSession::class, 'session_id');
    }

    //answer
    public function Answers()
    {
        return $this->hasMany(Answers::class, 'theme_id');
    }
}
