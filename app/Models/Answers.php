<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    // $table->foreignId('question_id')->nullable()->constrained()->onDelete('cascade'); // untuk sesi 3
    // $table->foreignId('statement_id')->nullable()->constrained()->onDelete('cascade'); // untuk sesi 2
    // $table->text('answer_text');

    protected $fillable = [
        'question_id',
        'statement_id',
        'answer_text',
    ];
    public function question()
    {
        return $this->belongsTo(Themes::class);
    }
    public function statement()
    {
        return $this->belongsTo(Statements::class);
    }
}
