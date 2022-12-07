<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $fillable = [
        'author_id',
        'text',
        'recipe_id',
    ];

    public function recipe() {
        return $this->hasOne(Recipe::class);
    }

    public function user() {
        return $this->hasMany(User::class, 'id', 'author_id');
    }
}
