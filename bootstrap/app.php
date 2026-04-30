<?php

use App\Http\Middleware\CheckRole;
use App\Http\Middleware\GlobalMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [__DIR__.'/../routes/web.php',
        __DIR__.'/../routes/admin.php',
        __DIR__.'/../routes/teacher.php',
        __DIR__.'/../routes/student.php',
        __DIR__.'/../routes/payment.php',
        __DIR__.'/../routes/schedule.php',
        __DIR__.'/../routes/shared.php',
        __DIR__.'/../routes/SchoolClass.php',
        __DIR__.'/../routes/Subject.php',
         __DIR__.'/../routes/User.php',],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->use([
        GlobalMiddleware::class
        ]);

        $middleware->alias([
            'teachers'=>TeacherMiddleware::class,
            'role' => CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();