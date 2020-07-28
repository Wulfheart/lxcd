<?php

namespace Wulfheart\Lxcd;

use Illuminate\Support\ServiceProvider;
use Wulfheart\Lxcd\Commands\LxcdCommand;

class LxcdServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/lxcd.php' => config_path('lxcd.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/lxcd'),
            ], 'views');

            if (! class_exists('CreatePackageTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_lxcd_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_lxcd_table.php'),
                ], 'migrations');
            }

            $this->commands([
                LxcdCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lxcd');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lxcd.php', 'lxcd');
    }
}
