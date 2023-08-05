<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Reply $reply)
    {
        /* si el usuario autenticado es el mismo que creó la respuesta, entonces puede editarla */
        /* en el controlador llamar así $this->authorize('update', $this->reply); */
        return $user->id === $reply->user_id; // true, false
    }
}
