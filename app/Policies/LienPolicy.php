<?php

namespace App\Policies;

use App\User;
use App\Lien;
use Illuminate\Auth\Access\HandlesAuthorization;

class LienPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function destroy(User $user, Lien $lien)
    {
        return $user->id === $lien->user_id;
    }
}
