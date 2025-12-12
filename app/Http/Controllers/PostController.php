<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Settings\BlogSettings;
use App\Services\ThemeService;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        $themeService = app(ThemeService::class);
        $settings = app(BlogSettings::class);

        return $themeService->view('posts', compact('posts','settings'));

    }
    public function show($slug)
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->with(['author', 'category', 'tags', 'approvedComments.replies'])
            ->firstOrFail();

        // Görüntülenme sayısını artır
        $post->increment('views');

        $settings = app(BlogSettings::class);
        $themeService = app(ThemeService::class);

        return $themeService->view('post', compact('post', 'settings'));
    }
}
