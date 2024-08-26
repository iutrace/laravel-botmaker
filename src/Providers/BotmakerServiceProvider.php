<?php

namespace Iutrace\Botmaker\Providers;

use Iutrace\Botmaker\Services\BotmakerService;
use Illuminate\Support\ServiceProvider;

class BotmakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/botmaker.php', 'botmaker'
        );

        $this->app->singleton('botmaker', function ($app) {
            return new BotmakerService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/botmaker.php' => config_path('botmaker.php'),
        ]);
    }
}