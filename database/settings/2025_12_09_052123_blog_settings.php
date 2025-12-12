<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('blog.site_name', 'GBlog');
        $this->migrator->add('blog.site_tagline', null);
        $this->migrator->add('blog.site_description', null);
        $this->migrator->add('blog.comments_enabled', true);
        $this->migrator->add('blog.default_meta_title', null);
        $this->migrator->add('blog.default_meta_description', null);
    }
};
