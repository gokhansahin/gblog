<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Page;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();

        // Ana sayfa
        $sitemap->add(Url::create(route('blog.index'))
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0));

        // Yazılar
        Post::published()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(Url::create(route('blog.post', $post->slug))
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        });

        // Kategoriler
        Category::all()->each(function (Category $category) use ($sitemap) {
            $sitemap->add(Url::create(route('blog.category', $category->slug))
                ->setLastModificationDate($category->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7));
        });

        // Etiketler
        Tag::all()->each(function (Tag $tag) use ($sitemap) {
            $sitemap->add(Url::create(route('blog.tag', $tag->slug))
                ->setLastModificationDate($tag->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.6));
        });

        // Sayfalar
        Page::published()->each(function (Page $page) use ($sitemap) {
            $sitemap->add(Url::create(route('blog.page', $page->slug))
                ->setLastModificationDate($page->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.7));
        });

        return $sitemap->toResponse(request());
    }
}
