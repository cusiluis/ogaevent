<?php
// app/Policies/EventoPolicy.php

namespace App\Policies;

use App\Models\Evento;
use App\Models\Usuario;

class EventoPolicy
{
    public function update(Usuario $user, Evento $evento)
    {
        return $user->isAdmin() || $user->id === $evento->created_by;
    }

    public function delete(Usuario $user, Evento $evento)
    {
        return $user->isAdmin() || $user->id === $evento->created_by;
    }
}