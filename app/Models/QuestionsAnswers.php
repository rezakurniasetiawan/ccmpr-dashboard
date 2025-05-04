<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionsAnswers extends Model
{
    // $table->foreignId('stage_id')->constrained()->onDelete('cascade');
    // $table->foreignId('session_id')->constrained('stage_sessions')->onDelete('cascade');
    // $table->text('question_text');
    // $table->text('answer_text');

    protected $fillable = [
        'stage_id',
        'session_id',
        'question_text',
        'answer_text',
        'is_correct',
    ];

    public function stage()
    {
        return $this->belongsTo(Stages::class);
    }

    public function session()
    {
        return $this->belongsTo(StageSession::class, 'session_id');
    }
}
