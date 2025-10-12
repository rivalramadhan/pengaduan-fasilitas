<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

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
        // Izin untuk mengelola laporan (bisa diakses admin & petugas)
        Gate::define('manage-reports', function (User $user) {
            return in_array($user->role, ['admin', 'petugas']);
        });

        // Izin HANYA untuk mengelola master data (hanya bisa diakses admin)
        Gate::define('manage-master-data', function (User $user) {
            return $user->role === 'admin';
        });
    }
}