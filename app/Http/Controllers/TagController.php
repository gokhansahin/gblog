<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Settings\BlogSettings;
use App\Services\ThemeService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        
        $posts = $tag->posts()
            ->published()
            ->with(['author', 'category', 'tags'])
            ->latest('published_at')
            ->paginate(10);

        $settings = app(BlogSettings::class);
        $themeService = app(ThemeService::class);

        return $themeService->view('tag', compact('tag', 'posts', 'settings'));
    }
}
