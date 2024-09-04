<?php

namespace Iutrace\Botmaker\Providers;

use Iutrace\Botmaker\Services\BotmakerService;
use Illuminate\Support\ServiceProvider;
use Iutrace\Botmaker\Commands\UpdateWhatsappTemplatesCommand;

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
            __DIR__.'/../../config/botmaker.php', 'botmaker'
        );

        $this->app->singleton('botmaker', function ($app) {
            return new BotmakerService();
        });

        $this->commands([
            UpdateWhatsappTemplatesCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/botmaker.php' => config_path('botmaker.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../../database/migrations/2024_08_26_120000_create_whatsapp_template_model_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_whatsapp_template_model_table.php'),
            __DIR__.'/../../database/migrations/2024_08_29_120000_create_whatsapp_templates_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_whatsapp_templates_table.php'),
        ], 'migrations');
    }
}