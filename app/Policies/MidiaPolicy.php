<?php

namespace App\Policies;

use App\Models\Midia;
use App\Models\User;

class MidiaPolicy
{
    public function view(User $user, Midia $midia)
    {
        return $user->id === $midia->usuario_id;
    }

    public function update(User $user, Midia $midia)
    {
        return $user->id === $midia->usuario_id;
    }

    public function delete(User $user, Midia $midia)
    {
        return $user->id === $midia->usuario_id;
    }
}