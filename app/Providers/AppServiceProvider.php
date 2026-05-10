<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define Gates
        Gate::define('access-student', function ($user) {
            return $user->role === 'admin' || $user->role === 'student';
        });

        Gate::define('access-teacher', function ($user) {
            return $user->role === 'admin' || $user->role === 'teacher';
        });
    }
}
