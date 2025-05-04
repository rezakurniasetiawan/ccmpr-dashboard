<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statements extends Model
{
    // $table->foreignId('stage_id')->constrained()->onDelete('cascade');
    // $table->foreignId('session_id')->constrained('stage_sessions')->onDelete('cascade');
    // $table->string('box_name');
    // $table->text('statement_text');

    protected $fillable = [
        'stage_id',
        'session_id',
        'box_name',
        'statement_text',
    ];

    public function stage()
    {
        return $this->belongsTo(Stages::class);
    }

    public function session()
    {
        return $this->belongsTo(StageSession::class, 'session_id');
    }

    // StatementsAnswers
    public function statementsAnswers()
    {
        return $this->hasMany(StatementsAnswers::class, 'statements_id');
    }
}
