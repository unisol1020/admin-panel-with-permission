<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('RoleService', 'App\Services\RoleService');
    }
}
