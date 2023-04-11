<?php

namespace App\Policies;

use App\Models\User;

class ApplicationPolicy
{
   
    public function __construct()
    {
        
    }

    public function index(User $user){
        return $user->role_id===2;
    }

    public function create(User $user){
        return $user->role_id===1;
    }
}
