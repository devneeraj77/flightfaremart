<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post; // Assuming this model is in App\Models

// Mocking User and Category models for demonstration
// In a real app, you would import these properly:
// use App\Models\User; 
// use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display the form for creating a new post.
     * * @return \Illuminate\View\View
     */
    public function create()
    {
        // --- Mock Data Setup ---
        // In a real application, you would fetch categories from the database:
        // $categories = Category::all();
        $categories = [
            (object)['id' => 1, 'name' => 'Technology'],
            (object)['id' => 2, 'name' => 'Travel'],
            (object)['id' => 3, 'name' => 'Lifestyle'],
        ];
        
        // Ensure only authenticated users can access this (usually via middleware)
        // We'll mock the user ID for the form submission.
        $mockUserId = 1;

        return view('admin.blog.allposts', compact('categories', 'mockUserId'));
    }

    /**
     * Store a newly created post in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validation (Highly Recommended!)
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id', // 'exists:categories,id' checks DB
            'image_url' => 'nullable|url',
            'published_at_date' => 'nullable|date',
            'is_published' => 'sometimes|boolean',
            'user_id' => 'required|exists:users,id',
        ]);
        
        // 2. Data Preparation
        $title = $validatedData['title'];
        $content = $validatedData['content'];
        $slug = Str::slug($title);
        
        // Generate excerpt from content (TinyMCE content needs cleanup first, but we'll use raw text for simplicity)
        $excerpt = Str::limit(strip_tags($content), 150);
        
        // Handle publishing date
        $publishedAt = $validatedData['published_at_date'] 
                     ? now()->parse($validatedData['published_at_date']) 
                     : null;

        $isPublished = $request->has('is_published');
        
        // 3. Create the Post
        $post = Post::create([
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'excerpt' => $excerpt,
            'user_id' => $validatedData['user_id'], // This should come from auth()->id() in a real app
            'category_id' => $validatedData['category_id'],
            'image_url' => $validatedData['image_url'] ?? null,
            'published_at' => $publishedAt,
            'is_published' => $isPublished,
        ]);

        // 4. Redirect
        // You would typically redirect to an 'edit' or 'list' page
        return redirect()->back()->with('success', 'Post "' . $post->title . '" created successfully!');
    }
}