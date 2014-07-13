<?php namespace Larrytech\Auth\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
    
    /**
     * {@inheritDoc}
     */
    public function register()
    {
        App::bind('Larrytech\Auth\Repositories\RoleRepositoryInterface', 'Larrytech\Auth\Repositories\DbRoleRepository');
        App::bind('Larrytech\Auth\Repositories\UserRepositoryInterface', 'Larrytech\Auth\Repositories\DbUserRepository');
    }
}