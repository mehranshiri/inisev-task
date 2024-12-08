<?php

namespace App\Http\Controllers;

use App\Events\PostPublished;
use App\Models\Website;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request, Website $website)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $post = $website->posts()->create($validated);

        // Dispatch the event after post is created
        event(new PostPublished($post));

        return response()->json(['message' => 'Post created successfully.', 'post' => $post], 201);
    }
}
