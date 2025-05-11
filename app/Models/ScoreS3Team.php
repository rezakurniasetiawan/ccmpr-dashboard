<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoreS3Team extends Model
{
    // $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
    // $table->integer('score')->nullable();
    // $table->integer('urutan')->nullable();

    protected $fillable = [
        'team_id',
        'score',
        'urutan',
    ];
    public function team()
    {
        return $this->belongsTo(Teams::class);
    }
}
