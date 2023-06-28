<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Task $task)
    {
        return $task->creator_id == $user->id
            ? Response::allow()
            : Response::deny('You are not allowed to delete this task.');
    }

    public function markAsCompleted(User $user, Task $task){
        return $task->assignee_id == $user->id
            ? Response::allow()
            : Response::deny('You are not allowed to mark this task as completed.');
    }

}
