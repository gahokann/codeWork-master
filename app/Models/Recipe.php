<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $fillable = [
        'title',
        'description',
        'code',
        'author_id',
        'rating',
        'category_id',
        'language_id',
    ];

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'recipe_tags');
    }

    public function language()
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function comment() {
        return $this->hasOne(Comment::class);
    }

    public function ratingRecipe() {
        return $this->hasOne(RatingRecipe::class, 'id', 'recipe_id');
    }
}
