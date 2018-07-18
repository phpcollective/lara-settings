<?php

namespace Phpcollective\Settings;

use Phpcollective\Settings\Models\Setting;
use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Support\ServiceProvider;
use Schema;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Contracts\Cache\Factory $cache
     *
     * @return void
     */
    public function boot(Cache $cache)
    {
        if(!$this->app->routesAreCached()){
            require __DIR__ . '/route.php';
        }

        /*$this->publishes(
            [__DIR__.'/config/authorization.php' => config_path('authorization.php')],
            'config'
        );*/

        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/phpcollective/settings')
        ]);

        $this->loadViewsFrom(resource_path('resources/views'), 'phpcollective/settings');
        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/phpcollective/settings')
        ]);

        $this->loadMigrationsFrom(database_path('migrations'));
        $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations')
        ]);

        $this->publishes([
            __DIR__ . '/seeds' => database_path('seeds')
        ]);

        $settings = Schema::hasTable('collective_settings') ? $cache->rememberForever('settings', function () {
            return Setting::pluck('value', 'key')->toArray();
        }) : [];

        config()->set('settings', $settings);
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
