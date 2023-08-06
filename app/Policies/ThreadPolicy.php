<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;

class ThreadPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Thread $thread)
    {
        /* si el usuario autenticado es el mismo que creó la pregunta, entonces puede editarla */
        /* en el controlador llamar así $this->authorize('update', $this->thread); */
        return $user->id === $thread->user_id; // true, false
    }
}
