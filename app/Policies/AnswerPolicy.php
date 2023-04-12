<?php

namespace App\Policies;

use App\Models\User;

class AnswerPolicy
{
   
    public function __construct()
    {
        
    }

    public function create(User $user){
        return $user->role_id===1;
    }
}
