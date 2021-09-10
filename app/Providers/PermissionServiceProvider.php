<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('PermissionService', 'App\Services\PermissionService');
    }
}
