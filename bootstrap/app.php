<?php

use App\Mail\ReturnBookEmail;
use App\Models\Borrow;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Student;
use Illuminate\Support\Facades\Mail;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);
        $middleware->alias([
            'admin' => Admin::class,
        ]);

        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->call(function () {
            $borrows = Borrow::with('user')->where('confirmed', 0)
            ->whereDate('returned_at', today())
            ->get();
        
            foreach ($borrows as $borrow) {
        
                Mail::to($borrow->user['email'])->send(new ReturnBookEmail($borrow->user['name'], $borrow->returned_at, $borrow->copy->book->name));
            }
        })->twiceDaily(8, 13);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
