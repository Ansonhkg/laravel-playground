<?php

namespace App\Http\Resources;

use App\Http\Resources\Role;
use Illuminate\Http\Resources\Json\Resource;

class User extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
     
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => Role::collection($this->roles),
            'remember_token' => $this->remember_token,
        ];
    }

}
