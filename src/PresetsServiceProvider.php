<?php

namespace LaPress\Presets;

use Illuminate\Foundation\Console\PresetCommand;
use Illuminate\Support\ServiceProvider;

class PresetsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro(Preset::KEY, function ($command) {
            Preset::install($command);

            $command->info('laPress scaffolding installed successfully.');
            $command->comment('Please run "php artisan lapress:make:theme && npm install" to compile your fresh scaffolding.');
        });
    }
}
