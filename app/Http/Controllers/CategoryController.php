<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Settings\BlogSettings;
use App\Services\ThemeService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $posts = $category->posts()
            ->published()
            ->with(['author', 'tags'])
            ->latest('published_at')
            ->paginate(10);

        $settings = app(BlogSettings::class);
        $themeService = app(ThemeService::class);

        return $themeService->view('category', compact('category', 'posts', 'settings'));
    }
}
