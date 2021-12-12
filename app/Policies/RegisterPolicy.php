<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegisterPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function before(User $user, $permission)
    {
        if($user->type == 'super-admin')
        {
            return true;
        }
    }
    public function register(User $user)
    {
        dd();
        return $user->hasPermission('users.register');
    }
}
