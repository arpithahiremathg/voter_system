<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        $this->registerPolicies();

        // Prevent login if user is not verified
        Auth::provider('eloquent', function ($app, $config) {
            return new \Illuminate\Auth\EloquentUserProvider($app['hash'], $config['model']);
        });

        Auth::extend('session', function ($app, $name, array $config) {
            return new \Illuminate\Auth\SessionGuard(
                $name,
                Auth::createUserProvider($config['provider']),
                $app['session.store']
            );
        });

        Auth::extend('verified', function ($app, $name, array $config) {
            return new \Illuminate\Auth\SessionGuard(
                $name,
                Auth::createUserProvider($config['provider']),
                $app['session.store']
            );
        });

        Route::get('/email/verify', function () {
            return view('auth.verify');
        })->middleware('auth')->name('verification.notice');
    }
}
