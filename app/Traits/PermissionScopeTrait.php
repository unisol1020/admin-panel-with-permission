<?php

namespace App\Traits;

use App\Facades\PermissionService;

trait PermissionScopeTrait
{
    protected static function booted()
    {
        // self::$entity => Needed for getting scope for a specific entity
        // self::$time => Needed to set the maximum number of repetitions to call a scope

        parent::booted();

        if (class_exists(\App\Services\PermissionService::class) && method_exists(\App\Services\PermissionService::class , 'getGlobalScope')) {
            static::addGlobalScope(PermissionService::getGlobalScope(self::$entity ?? null , self::$time ?? null));
        } else {
            abort(404);
        }
    }
}
