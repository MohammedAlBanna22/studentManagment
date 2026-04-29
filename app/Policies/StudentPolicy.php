<?php

namespace App\Policies;

use App\Models\student;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StudentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, student $student): bool
    {
        // ✅ admin can view any student
       if ($user->user_type === 'admin') {
    return true;
}

        // ✅ teacher can view any student
        if ($user->user_type === 'teacher') {
            return true;
        }

        // ✅ student can only view their own profile
        return $student->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function updateStudents(User $user, student $student): bool
    {
        return $user->id===$student->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, student $student): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, student $student): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, student $student): bool
    {
        return false;
    }
}
