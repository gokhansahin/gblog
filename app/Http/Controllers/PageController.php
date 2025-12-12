<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Settings\BlogSettings;
use App\Services\ThemeService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $settings = app(BlogSettings::class);
        $themeService = app(ThemeService::class);

        return $themeService->view('page', compact('page', 'settings'));
    }
}
