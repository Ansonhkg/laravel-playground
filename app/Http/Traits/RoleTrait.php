<?php

namespace App\Http\Traits;

use App\Role;

trait RoleTrait{
    /**
     * Return all existing roles
     *
     * @return array
     */
    public function allRoles(){
        return Role::all();        
    }

}