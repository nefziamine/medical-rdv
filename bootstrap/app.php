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
    ->withSchedule(function (\Illuminate\Console\Scheduling\Schedule $schedule): void {
        // Nettoyage automatique des créneaux expirés chaque heure
        $schedule->call(function () {
            \App\Models\Appointment::where('status', 'pending')
                ->where('appointment_date', '<', date('Y-m-d'))
                ->orWhere(function($query) {
                    $query->where('appointment_date', '=', date('Y-m-d'))
                          ->where('appointment_time', '<', date('H:i'));
                })
                ->update(['status' => 'cancelled']);
        })->hourly();
    })
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
