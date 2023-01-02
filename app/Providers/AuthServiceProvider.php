<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\DataBahan' => 'App\Policies\DataBahanPolicy',
        'App\Models\Satuan' => 'App\Policies\SatuanMassaPolicy',
        'App\Models\BahanMasuk' => 'App\Policies\BahanMasukPolicy',
        'App\Models\BahanKeluar' => 'App\Policies\BahanKeluarPolicy',
        'App\Models\Mobil' => 'App\Policies\MobilPolicy',
        'App\Models\Sopir' => 'App\Policies\SopirPolicy',
        'App\Models\ProdukJadi' => 'App\Policies\ProdukJadiPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('backoffice', function (User $user) {
            return $user->role == 'backoffice';
        });

        Gate::define('gudang', function (User $user) {
            return $user->role == 'gudang';
        });

        Gate::define('produksi', function (User $user) {
            return $user->role == 'produksi';
        });

        Gate::define('distribusi', function (User $user) {
            return $user->role == 'distribusi';
        });
    }
}
