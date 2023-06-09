<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $fillable = [
        'role_name',
        'role_info',
    ];

    public function user() {
        return $this->hasOne(User::class);
    }
}
