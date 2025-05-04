<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    // $table->foreignId('theme_id')->nullable()->constrained()->onDelete('set null'); // untuk sesi 1
    //         $table->text('answer_text');

    protected $fillable = [
        'theme_id',
        'answer_text',
        'is_correct',
    ];

    public function theme()
    {
        return $this->belongsTo(Themes::class, 'theme_id');
    }
  
}
