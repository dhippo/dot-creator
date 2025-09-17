<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Optionnel : créer un alias si tu veux l'utiliser sur des routes : 'setlocale'
        $middleware->alias([
            'setlocale' => \App\Http\Middleware\SetLocale::class,
        ]);

        // Important : l'ajouter au groupe "web" pour avoir la session
        $middleware->appendToGroup('web', \App\Http\Middleware\SetLocale::class);

        // Variante (global) : $middleware->append(\App\Http\Middleware\SetLocale::class);
        // Mais pour la session, la version "web" est plus sûre.
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
