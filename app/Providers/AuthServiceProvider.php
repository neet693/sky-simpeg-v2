<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Policies\EmployeePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Daftarkan policy untuk User
        User::class => EmployeePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Menambahkan gate untuk add-editProfile
        Gate::define('add-editProfile', [EmployeePolicy::class, 'addorEditProfile']);
    }
}
