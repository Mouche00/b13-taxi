<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Driver;
use App\Models\Passenger;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('admin', function(User $user){
            return sizeof(Admin::where('user_id', $user->id)->get()) > 0;
        });

        Gate::define('passenger', function(User $user){
            return sizeof(Passenger::where('user_id', $user->id)->get()) > 0;
        });

        Gate::define('driver', function(User $user){
            return sizeof(Driver::where('user_id', $user->id)->get()) > 0;
        });
    }
}
