<?php

namespace LaPress\Presets;

use File;
use Illuminate\Foundation\Console\Presets\Preset as BasePreset;

/**
 * @author Sebastian Szczepański
 * @copyright Ably
 */
class Preset extends BasePreset
{
    const KEY = 'lapress';

    public static function install($command)
    {
        static::cleanDirectories($command);
        static::updatePackages();
        static::updateMix();
        static::addWordPressPath();
    }

    protected static function cleanDirectories($command)
    {
        try {
            File::deleteDirectory(base_path('wordpress'));
            File::deleteDirectory(resource_path('sass'));
            File::deleteDirectory(resource_path('js'));
            File::makeDirectory(resource_path('themes'));
        } catch (\Exception $e) {

        }
    }

    public static function updatePackageArray($packages)
    {
        return [
            'axios'                => '^0.18',
            'bootstrap'            => '^4.0.0',
            'cross-env'            => '^5.1',
            'laravel-mix'          => '^2.0',
            'lodash'               => '^4.17.5',
            'popper.js'            => '^1.12',
            'vue'                  => '^2.5.7',
            'laravel-mix-purgecss' => '^2.2.3',
            'tailwindcss'          => '^0.6.5',
            'normalize.css'          => '^8.0.0',
            'suitcss-base'          => '^4.0.0',
        ];
    }

    protected static function addWordPressPath()
    {
        $packages = json_decode(file_get_contents(base_path('composer.json')), true);

        $packages['extra'] = $packages['extra'] ?? [];
        $packages['extra'] = array_merge($packages['extra'], [
            'wordpress-install-dir' => 'storage/wordpress',
        ]);

        file_put_contents(
            base_path('composer.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }


    protected static function updateMix()
    {
        copy(__DIR__.'/stubs/webpack.mix.js.stub', base_path('webpack.mix.js'));
    }

}
