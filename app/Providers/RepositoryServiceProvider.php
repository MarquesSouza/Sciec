<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TypeUserRepository::class, \App\Repositories\TypeUserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserTypeUserRepository::class, \App\Repositories\UserTypeUserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserTypeRepository::class, \App\Repositories\UserTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstitutionRepository::class, \App\Repositories\InstitutionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TypeActivityRepository::class, \App\Repositories\TypeActivityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EventRepository::class, \App\Repositories\EventRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ActivityRepository::class, \App\Repositories\ActivityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserActivityTypeRepository::class, \App\Repositories\UserActivityTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EventsUserRepository::class, \App\Repositories\EventsUserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UsersActivityRepository::class, \App\Repositories\UsersActivityRepositoryEloquent::class);
        //:end-bindings:
    }
}
