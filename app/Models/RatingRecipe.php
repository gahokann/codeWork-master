<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingRecipe extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $fillable = [
        'recipe_id',
        'user_id',
        'number',
    ];

    public function user() {
        return $this->hasOne(User::class);
    }

    public function recipe() {
        return $this->hasOne(Recipe::class, 'recipe_id', 'id');
    }
}
