<?php
// app/Providers/AuthServiceProvider.php

namespace App\Providers;

use App\Models\Evento;
use App\Policies\EventoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Evento::class => EventoPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}