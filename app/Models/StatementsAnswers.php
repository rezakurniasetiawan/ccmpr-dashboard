<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatementsAnswers extends Model
{
    // $table->foreignId('statements_id')->constrained('statements')->onDelete('cascade');
    // $table->enum('type', ['pro', 'kontra']);
    // $table->text('answer_text');

    protected $fillable = [
        'statements_id',
        'type',
        'answer_text',
        'is_correct',
    ];

    public function statement()
    {
        return $this->belongsTo(Statements::class, 'statements_id');
    }
    
}
