<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded=[];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role_id',
        'login',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userInfo() {
        return $this->hasOne(UserInfo::class);
    }

    public function recipe() {
        return $this->hasOne(Recipe::class);
    }

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function comment() {
        return $this->hasMany(Comment::class, 'author_id', 'id');
    }

    public function category() {
        return $this->hasMany(Category::class, 'admin_id', 'id');
    }

    public function isAdmin()
    {
        return $this->role_id === 2 || $this->login == "admin";
    }

    public function ratingRecipe() {
        return $this->hasOne(RatingRecipe::class);
    }
}
