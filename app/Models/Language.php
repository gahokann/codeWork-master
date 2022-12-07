<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $fillable = [
        'language',
        'aliases',
    ];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
