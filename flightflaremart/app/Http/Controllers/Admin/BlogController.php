<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post; // Assuming you have a Post model
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    /**
     * Display a listing of all posts for the admin.
     * 
     */
   public function create()
    {
        // This returns the view you specified
        return view('admin.blog.AddNewPost');
    }

    /**
     * Store a newly created blog post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url',
            'image_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'admin_id' => auth('admin')->id(),
            'is_published' => $request->has('is_published'),
            'published_at' => $request->published_at,
        ]);

        if ($request->has('image_url')) {
            $imageAsset = new \App\Models\ImageAsset([
                'url' => $request->image_url,
                'is_url' => true,
                'post_id' => $post->id,
                'paths' => null, // No local paths for URL images
            ]);
            $imageAsset->save();
        } elseif ($request->hasFile('image_upload')) {
            $image = $request->file('image_upload');
            $imageName = time() . '.' . $image->extension();
            $imagePath = 'images/posts/' . $imageName;

            try {
                $manager = new ImageManager(new Driver());
                $imageIntervention = $manager->read($image->getRealPath());

                $webpImageName = time() . '.webp';
                $webpImagePath = 'images/posts/' . $webpImageName;
                $imageIntervention->toWebp(75)->save(public_path($webpImagePath));

                $imageAsset = new \App\Models\ImageAsset([
                    'paths' => ['webp' => $webpImagePath],
                    'is_url' => false,
                    'post_id' => $post->id,
                ]);
                $imageAsset->save();
            } catch (\Exception $e) {
                $image->move(public_path('images/posts'), $imageName);
                $imageAsset = new \App\Models\ImageAsset([
                    'paths' => ['original' => $imagePath],
                    'is_url' => false,
                    'post_id' => $post->id,
                ]);
                $imageAsset->save();
            }
        }

        return redirect()->route('admin.posts.index')->with('success', 'Blog post created successfully!');
    }

    public function allPosts()
    {
        // 1. Fetch all posts (or paginate them for a real application)
        // For testing, we will pass a simple array if the Post model doesn't exist yet.
        try {
            $posts = Post::all()->sortByDesc('created_at');
        } catch (\Throwable $th) {
            // Fallback for testing if the DB/Model is not set up
            $posts = collect([
                (object)['id' => 1, 'title' => 'First Test Post', 'slug' => 'first-test-post', 'created_at' => now()],
                (object)['id' => 2, 'title' => 'Second Test Post', 'slug' => 'second-test-post', 'created_at' => now()],
                (object)['id' => 3, 'title' => 'thrid Test Post', 'slug' => 'third-test-post', 'created_at' => now()->subDay()],
            ]);
        }
        
        // 2. Return the view with the data
        return view('admin.blog.allposts', compact('posts'));
    }
}