<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ThemeMetaSettings extends Settings
{
    public array $meta = [];

    public static function group(): string
    {
        return 'theme_meta';
    }
}


