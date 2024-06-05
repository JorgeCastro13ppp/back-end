<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        if (is_array($middleware)) {
            $middleware[] = \App\Http\Middleware\Cors::class;
        } else {
            $middleware = [\App\Http\Middleware\Cors::class];
        }
        return $middleware;

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
