<?php

namespace App\Http\Middleware;

use App\Facades\PermissionService;
use Closure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckUserPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (PermissionService::check()) {
            return $next($request);
        }

        throw new AccessDeniedHttpException('Access denied');
    }
}
