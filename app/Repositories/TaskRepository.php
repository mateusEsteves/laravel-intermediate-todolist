<?php

namespace App\Repositories;

use App\User;

class TaskRepository
{
    public function getTasksForUser(User $user){
        return $user->tasks()
        ->orderBy('created_at', 'asc')
        ->get();
    }
}