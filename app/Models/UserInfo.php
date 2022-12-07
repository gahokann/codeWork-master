<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $guarded=[];


    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'birth_date',
    ];

    public function user() {
        return $this->hasOne(User::class);
    }

}
