<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'role.session' => \App\Http\Middleware\SwitchSessionForRole::class,
        ]);
        
        $middleware->redirectGuestsTo(function ($request) {
            // For admin routes, redirect to admin login
            if ($request->is('admin/*') || $request->is('admin')) {
                return route('admin.login');
            }
            // For other routes, redirect to login
            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
