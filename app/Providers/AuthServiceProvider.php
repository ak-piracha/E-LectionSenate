<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Policies\PermissionPolicy;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Policies\RolePolicy;
use App\Policies\VoterPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Permission::class => PermissionPolicy::class,
        Role::class => RolePolicy::class,
        Voter::class=>VoterPolicy::class,
        Election::class=>ElectionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
