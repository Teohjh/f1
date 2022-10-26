<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
    protected function redirectToConsumer($request)
    {
        if (! $request->expectsJson()) {
            return redirect()->intended('/consumer/index');
        }
    }
    protected function redirectToAdmin($request)
    {
        if (! $request->expectsJson()) {
            return redirect()->intended('/admin/dashboard');
        }
    }
}
