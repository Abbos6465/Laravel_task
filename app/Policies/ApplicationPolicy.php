<?php

namespace App\Policies;

use App\Models\User;

class ApplicationPolicy
{
   
    public function __construct()
    {
        
    }

    public function index(User $user){
        dd("Application");
        return $user->role_id===2;
    }

}
