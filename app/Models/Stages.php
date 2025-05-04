<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stages extends Model
{
    // $table->foreignId('province_id')->constrained()->onDelete('cascade');
    // $table->string('name'); // Penyisihan 1, 2, 3, Final

    protected $fillable = [
        'province_id',
        'name',
        'kode',
    ];

    public function province()
    {
        return $this->belongsTo(Provinces::class);
    }
}
