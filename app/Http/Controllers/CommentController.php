<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Settings\BlogSettings;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $settings = app(BlogSettings::class);

        if (!$settings->comments_enabled) {
            return back()->with('error', 'Yorumlar şu anda kapalı.');
        }

        $validated = $request->validate([
            'name' => 'required_if:user_id,null|string|max:255',
            'email' => 'required_if:user_id,null|email|max:255',
            'content' => 'required|string|max:5000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $validated['post_id'] = $post->id;
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        Comment::create($validated);

        return back()->with('success', 'Yorumunuz gönderildi. Onaylandıktan sonra yayınlanacaktır.');
    }
}
