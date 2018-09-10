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
        static::cleanSassDirectory();
    }

    public static function cleanSassDirectory()
    {
        File::cleanDirectory(resource_path('assets/sass'));
    }
}
