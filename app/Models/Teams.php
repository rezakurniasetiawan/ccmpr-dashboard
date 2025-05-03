<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    // $table->foreignId('school_id')->constrained()->onDelete('cascade');
    // $table->string('team_name'); 
    protected $fillable = [
        'school_id',
        'team_name',
    ];

    public function school()
    {
        return $this->belongsTo(Schools::class);
    }
}
