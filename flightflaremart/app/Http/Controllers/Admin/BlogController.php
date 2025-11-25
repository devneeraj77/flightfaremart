<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post; // Assuming you have a Post model
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of all posts for the admin.
     */
    public function allPosts()
    {
        // 1. Fetch all posts (or paginate them for a real application)
        // For testing, we will pass a simple array if the Post model doesn't exist yet.
        try {
            $posts = Post::latest()->get();
        } catch (\Throwable $th) {
            // Fallback for testing if the DB/Model is not set up
            $posts = collect([
                (object)['id' => 1, 'title' => 'First Test Post', 'slug' => 'first-test-post', 'created_at' => now()],
                (object)['id' => 2, 'title' => 'Second Test Post', 'slug' => 'second-test-post', 'created_at' => now()->subDay()],
            ]);
        }
        
        // 2. Return the view with the data
        return view('admin.blog.allposts', compact('posts'));
    }
}