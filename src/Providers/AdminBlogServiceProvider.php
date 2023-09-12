<?php

namespace Uiaciel\Adminblog\Providers;

use Illuminate\Support\ServiceProvider;

class AdminBlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/admincp', 'admincp');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../resources/views/layouts/admin.blade.php' => resource_path('views/layouts/admin.blade.php'),

        ]);

        $this->publishes([
            __DIR__ . '/../public' => public_path('assets'),
        ], 'public');
    }
}
