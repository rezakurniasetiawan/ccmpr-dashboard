<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    // $table->foreignId('theme_id')->nullable()->constrained()->onDelete('set null');
    // $table->foreignId('session_id')->constrained()->onDelete('cascade');
    // $table->text('question_text');


    protected $fillable = [
        'theme_id',
        'session_id',
        'question_text',
    ];

    public function session()
    {
        return $this->belongsTo(StageSession::class);
    }

    public function theme()
    {
        return $this->belongsTo(Themes::class);
    }
}
