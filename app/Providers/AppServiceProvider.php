<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

        view()->composer('*',function($view) {

            if (Auth::user()) {

                $userOrg = User::Join('organization_armories', 'organization_armories.id', '=', 'users.organization_id')
                    ->get('organization_armories.organization');

                $view->with('userOrg', isset($userOrg[0]->organization) ? $userOrg[0]->organization : null);
            }

        });
    }
}
