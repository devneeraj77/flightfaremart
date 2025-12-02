<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\ImageAsset;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Str; // For slug generation

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'author', 'imageAsset')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:posts,title',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'is_published' => 'boolean',
            'image_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // 2MB Max
            'image_url' => 'nullable|url|max:2048',
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->slug = Str::slug($validated['title']);
        $post->content = $validated['content'];
        $post->excerpt = $validated['excerpt'];
        $post->category_id = $validated['category_id'];
        $post->admin_id = auth()->guard('admin')->id(); // Assuming authenticated admin
        $post->is_published = $request->has('is_published');
        $post->published_at = $post->is_published ? now() : null;
        $post->save();

        if ($request->hasFile('image_upload')) {
            try {
                $uploadedFileUrl = Cloudinary::upload($request->file('image_upload')->getRealPath())->getSecurePath();
                $publicId = Cloudinary::getPublicId();

                ImageAsset::create([
                    'url' => $uploadedFileUrl,
                    'is_url' => false,
                    'post_id' => $post->id,
                    'cloudinary_id' => $publicId,
                ]);
            } catch (\Exception $e) {
                // Log the error and redirect back with a message
                \Log::error('Cloudinary Upload Error: ' . $e->getMessage());
                return back()->withInput()->with('error', 'Failed to upload image to Cloudinary. Please try again.');
            }
        } elseif ($request->filled('image_url')) {
            ImageAsset::create([
                'url' => $validated['image_url'],
                'is_url' => true,
                'post_id' => $post->id,
                'cloudinary_id' => null, // No Cloudinary ID for external URLs
            ]);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $post->load('imageAsset'); // Eager load image asset for the form
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:posts,title,' . $post->id,
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'is_published' => 'boolean',
            'image_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // 2MB Max
            'image_url' => 'nullable|url|max:2048',
        ]);

        $post->title = $validated['title'];
        $post->slug = Str::slug($validated['title']);
        $post->content = $validated['content'];
        $post->excerpt = $validated['excerpt'];
        $post->category_id = $validated['category_id'];
        $post->is_published = $request->has('is_published');
        $post->published_at = $post->is_published ? ($post->published_at ?? now()) : null; // Keep old date if exists
        $post->save();

        // Handle image update
        if ($request->hasFile('image_upload')) {
            try {
                // Delete old image from Cloudinary if it exists
                if ($post->imageAsset && $post->imageAsset->cloudinary_id) {
                    Cloudinary::destroy($post->imageAsset->cloudinary_id);
                    $post->imageAsset->delete(); // Delete the old ImageAsset record
                }

                $uploadedFileUrl = Cloudinary::upload($request->file('image_upload')->getRealPath())->getSecurePath();
                $publicId = Cloudinary::getPublicId();

                ImageAsset::create([
                    'url' => $uploadedFileUrl,
                    'is_url' => false,
                    'post_id' => $post->id,
                    'cloudinary_id' => $publicId,
                ]);
            } catch (\Exception $e) {
                \Log::error('Cloudinary Upload Error (Update): ' . $e->getMessage());
                return back()->withInput()->with('error', 'Failed to upload image to Cloudinary during update. Please try again.');
            }
        } elseif ($request->filled('image_url')) {
            try {
                // If a new URL is provided, and there was an old Cloudinary image, delete it
                if ($post->imageAsset && $post->imageAsset->cloudinary_id) {
                    Cloudinary::destroy($post->imageAsset->cloudinary_id);
                    $post->imageAsset->delete(); // Delete the old ImageAsset record
                }

                ImageAsset::create([
                    'url' => $validated['image_url'],
                    'is_url' => true,
                    'post_id' => $post->id,
                    'cloudinary_id' => null,
                ]);
            } catch (\Exception $e) {
                \Log::error('Cloudinary Delete Error (Update with new URL): ' . $e->getMessage());
                return back()->withInput()->with('error', 'Failed to process image during update with new URL. Please try again.');
            }
        } elseif ($request->boolean('clear_image') && $post->imageAsset) {
            try {
                // Option to clear existing image without uploading new one
                if ($post->imageAsset->cloudinary_id) {
                    Cloudinary::destroy($post->imageAsset->cloudinary_id);
                }
                $post->imageAsset->delete();
            } catch (\Exception $e) {
                \Log::error('Cloudinary Delete Error (Clear Image): ' . $e->getMessage());
                return back()->withInput()->with('error', 'Failed to clear image from Cloudinary. Please try again.');
            }
        }


        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Delete associated image from Cloudinary if it exists
        if ($post->imageAsset) {
            if ($post->imageAsset->cloudinary_id) {
                try {
                    Cloudinary::destroy($post->imageAsset->cloudinary_id);
                } catch (\Exception $e) {
                    \Log::error('Cloudinary Delete Error (Destroy Post): ' . $e->getMessage());
                    // Continue with deleting local record even if Cloudinary deletion fails
                }
            }
            $post->imageAsset->delete(); // This will trigger the ImageAsset model's deleting event
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }

    /**
     * Toggle the publish status of the specified resource.
     */
    public function togglePublish(Post $post)
    {
        $post->is_published = !$post->is_published;
        $post->published_at = $post->is_published ? ($post->published_at ?? now()) : null;
        $post->save();

        return back()->with('success', 'Post publish status updated successfully!');
    }
}
