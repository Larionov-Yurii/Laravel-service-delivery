<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ValidateRecipientData;
use App\Http\Middleware\ValidateParcelData;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['validate.recipient' => ValidateRecipientData::class]);
        $middleware->alias(['validate.parcel' => ValidateParcelData::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
