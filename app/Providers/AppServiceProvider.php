<?php

namespace App\Providers;

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
        Gate::define('manage-series', function (User $user) {
            return $user->hasRole('super_admin');
        });

        // Definir les portes per a la gestió de vídeos
        Gate::define('create-videos', function (User $user) {
            return $user->hasPermissionTo('create videos');
        });

        Gate::define('edit-videos', function (User $user) {
            return $user->hasPermissionTo('edit videos');
        });

        Gate::define('delete-videos', function (User $user) {
            return $user->hasPermissionTo('delete videos');
        });

        // Definir les portes per a la gestió d'usuaris
        Gate::define('manage-users', function (User $user) {
            return $user->isSuperAdmin();
        });

        // Porta per a la gestió de vídeos, accessible per video managers i super admins
        Gate::define('manage-videos', function (User $user) {
            return $user->hasRole('video_manager') || $user->isSuperAdmin() || $user->hasRole('regular');
        });

    }
}
