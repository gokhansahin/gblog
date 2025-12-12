<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Settings\BlogSettings;
use App\Services\ThemeService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::published()
            ->with(['author', 'category', 'tags'])
            ->latest('published_at')
            ->paginate(10);

        $categories = Category::withCount('posts')->get();
        $settings = app(BlogSettings::class);
        $themeService = app(ThemeService::class);

        return $themeService->view('index', compact('posts', 'categories', 'settings'));
    }
}
