<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SitemapController;

// Blog Routes
Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('blog.post');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('blog.category');
Route::get('/tag/{slug}', [TagController::class, 'show'])->name('blog.tag');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('blog.page');
Route::get('/posts', [PostController::class, 'index'])->name('blog.posts');

// Comments
Route::post('/post/{post}/comment', [CommentController::class, 'store'])->name('blog.comment.store');

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
