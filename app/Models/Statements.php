<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statements extends Model
{
    // $table->foreignId('session_id')->constrained()->onDelete('cascade'); // hanya sesi 2
    // $table->enum('type', ['pro', 'contra']);
    // $table->text('statement_text');

    protected $fillable = [
        'session_id',
        'type',
        'statement_text',
    ];

    public function session()
    {
        return $this->belongsTo(StageSession::class);
    }
}
