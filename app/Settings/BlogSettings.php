<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class BlogSettings extends Settings
{
    public string $site_name;
    public ?string $site_tagline;
    public ?string $site_description;
    public bool $comments_enabled;
    public ?string $default_meta_title;
    public ?string $default_meta_description;
    public string $theme;

    public static function group(): string
    {
        return 'blog';
    }
}

