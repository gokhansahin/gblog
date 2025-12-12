<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Page;
use App\Settings\BlogSettings;
use Illuminate\Support\Facades\View;

class ThemeService
{
    protected BlogSettings $settings;

    public function __construct(BlogSettings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Aktif temayı al
     */
    public function getActiveTheme(): string
    {
        return $this->settings->theme ?? 'default';
    }

    /**
     * Tema view path'ini al
     */
    public function getThemeViewPath(string $view): string
    {
        $theme = $this->getActiveTheme();
        return "themes.{$theme}.{$view}";
    }

    /**
     * Tema view'ını render et
     */
    public function view(string $view, array $data = []): \Illuminate\Contracts\View\View
    {
        $themeView = $this->getThemeViewPath($view);

        // Ortak menü verilerini her tema view'ına ekle
        if (! array_key_exists('menuCategories', $data)) {
            $data['menuCategories'] = Category::select('id', 'name', 'slug')->orderBy('name')->get();
        }

        if (! array_key_exists('menuPages', $data)) {
            $data['menuPages'] = Page::published()
                ->select('id', 'title', 'slug')
                ->orderBy('title')
                ->get();
        }

        // Tema view'ı yoksa varsayılan tema view'ını kullan
        if (!View::exists($themeView)) {
            $themeView = "themes.default.{$view}";
        }

        return view($themeView, $data);
    }

    /**
     * Mevcut temaları listele
     */
    public function getAvailableThemes(): array
    {
        $themesPath = resource_path('views/themes');
        $themes = [];

        if (is_dir($themesPath)) {
            $directories = array_filter(glob($themesPath . '/*'), 'is_dir');
            foreach ($directories as $dir) {
                $themeName = basename($dir);
                $themes[$themeName] = $this->getThemeInfo($themeName);
            }
        }

        return $themes;
    }

    /**
     * Tema bilgilerini al
     */
    protected function getThemeInfo(string $themeName): array
    {
        $infoPath = resource_path("views/themes/{$themeName}/theme.json");
        
        $defaultInfo = [
            'name' => ucfirst($themeName),
            'description' => '',
            'version' => '1.0.0',
            'author' => '',
        ];

        if (file_exists($infoPath)) {
            $info = json_decode(file_get_contents($infoPath), true);
            return array_merge($defaultInfo, $info ?? []);
        }

        return $defaultInfo;
    }

    /**
     * Tema asset path'ini al
     */
    public function asset(string $path): string
    {
        $theme = $this->getActiveTheme();
        return asset("themes/{$theme}/{$path}");
    }
}

