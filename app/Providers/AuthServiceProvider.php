<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit', function ($user, $profile) {
            return $user->id === $profile->id;
        });

        Gate::define('album_owner', function ($user, $album) {
            return $user->id === $album->user_id;
        });

        Gate::define('is_photographer', function($user, $thisUser = "") {
            if ($thisUser !== "") {
                return ($thisUser->role_id === DB::Table('roles')->where('name', 'photographer')->first()->id);
            }

            return ($user->role_id === DB::Table('roles')->where('name', 'photographer')->first()->id);
        });

        Gate::define('is_customer', function($user, $thisUser = "") {
            if ($thisUser !== "") {
                return ($thisUser->role_id === DB::Table('roles')->where('name', 'photographer')->first()->id);
            }

            return ($user->role_id === DB::Table('roles')->where('name', 'customer')->first()->id);
        });
    }
}
