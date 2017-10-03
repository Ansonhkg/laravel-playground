<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public static function findBySlug($slug){

        return Role::where('slug', $slug)->firstOrFail()->id;

    }

}
