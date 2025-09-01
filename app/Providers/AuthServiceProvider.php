<?php

namespace App\Providers;

use App\Models\Midia;
use App\Policies\MidiaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Midia::class => MidiaPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}