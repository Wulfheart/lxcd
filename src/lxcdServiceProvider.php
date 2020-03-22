<?php

namespace wulfheart\lxcd;

use Illuminate\Support\ServiceProvider;

class lxcdServiceProvider extends ServiceProvider
{
    public function boot(){
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__, 'lxcd');

    }

    public function register()
    {
    }
}
