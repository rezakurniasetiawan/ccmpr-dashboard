<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    // $table->foreignId('stage_id')->constrained()->onDelete('cascade');
    // $table->string('team_name');
    // $table->string('school_name');
    // $table->integer('score_sesi1')->nullable();
    // $table->integer('score_sesi2')->nullable();
    // $table->integer('score_sesi3')->nullable();
    // $table->integer('total_score_before')->nullable();
    // $table->integer('total_score_after')->nullable();

    protected $fillable = [
        'stage_id',
        'team_name',
        'school_name',
        'score_sesi1',
        'score_sesi2',
        'score_sesi3',
        'total_score_before',
        'total_score_after',
        'pro_kontra',
    ];
    
}
