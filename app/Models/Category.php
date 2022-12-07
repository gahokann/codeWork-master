<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $fillable = [
        'name',
        'admin_id',
    ];

    public function recipe() {
        return $this->hasMany(Recipe::class);
    }

    public function user() {
        return $this->hasMany(User::class, 'id', 'admin_id');
    }
}
