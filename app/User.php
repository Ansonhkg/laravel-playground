<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function hasRole($slug){
        return $this->roles()->where(['slug' => $slug])->exists();
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function images(){
        return $this->hasMany(Image::class, 'user_id', 'id');
    }

    public function profilePic(){
        return $this->images()->where(['user_id' => Auth::user()->id, 'type' => 'profile'])->first()->path;
    }
}
