<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User; // Assuming User model is needed for author assignment
use App\Models\Category; // Assuming Category model is needed for relationships
use App\Http\Requests\Admin\Blog\PostRequest;
use App\Models\Admin;
use App\Models\ImageAsset;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all posts, ordered by latest, with relationships
        $posts = Post::with(['author', 'category'])->latest()->paginate(10);
        return view('admin.blog.posts.index', compact('posts'));
    }

    /**
     * Display a listing of the draft posts.
     * @return \Illuminate\View\View
     */
    public function drafts()
    {
        // Fetch all posts, ordered by latest, with relationships
        $posts = Post::with(['author', 'category'])->where('is_published', false)->latest()->paginate(10);
        return view('admin.blog.posts.drafts', compact('posts'));
    }

    /**
     * Show the for for creating a new post.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Get necessary data for the form (e.g., categories and authors)
        $post = new Post();
        $categories = Category::all();
        // Assuming all users can be authors
        $authors = Admin::select('id', 'name')->get();

        return view('admin.blog.posts.create', compact('post', 'categories', 'authors'));
    }

    /**
     * Store a newly created post in storage.
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();
        
        // Create the post first
        $post = Post::create($data);

        // Handle the image asset
        if ($request->input('image_source') === 'url' && $request->filled('image_url')) {
            $post->imageAsset()->create([
                'url' => $request->input('image_url'),
                'is_url' => true,
            ]);
        } elseif ($request->input('image_source') === 'upload' && $request->hasFile('image_upload')) {
            $file = $request->file('image_upload');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/images/posts', $filename);
            
            $post->imageAsset()->create([
                'path' => 'storage/images/posts/' . $filename,
                'is_url' => false,
            ]);
        }

        return redirect()->route('admin.blog.posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Show the form for editing the specified post.
     * @param Post $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $categories = Category::all(['id', 'name']);
        $authors = Admin::select('id', 'name')->get();

        return view('admin.blog.posts.edit', compact('post', 'categories', 'authors'));
    }

    /**
     * Update the specified post in storage.
     * @param PostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();
        
        // Update the post
        $post->update($data);

        // Handle the image asset
        if ($request->input('image_source') === 'url' && $request->filled('image_url')) {
            // If there's an existing asset, update it. Otherwise, create a new one.
            $post->imageAsset()->updateOrCreate(['id' => $post->id], [
                'url' => $request->input('image_url'),
                'path' => null,
                'is_url' => true,
            ]);
        } elseif ($request->input('image_source') === 'upload' && $request->hasFile('image_upload')) {
            // Delete old image if it exists and is a file upload
            if ($post->imageAsset && !$post->imageAsset->is_url) {
                // The path in DB is 'storage/images/posts/...'
                // We need to convert it to a path that File::delete can use, which is inside storage/app/public
                $oldPath = str_replace('storage/', 'public/', $post->imageAsset->path);
                Storage::delete($oldPath);
            }

            $file = $request->file('image_upload');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/images/posts', $filename);
            
            $post->imageAsset()->updateOrCreate(['id' => $post->id], [
                'path' => 'storage/images/posts/' . $filename,
                'url' => null,
                'is_url' => false,
            ]);
        }

        return redirect()->route('admin.blog.posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from storage.
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        if ($post->imageAsset && !$post->imageAsset->is_url) {
            $oldPath = str_replace('storage/', 'public/', $post->imageAsset->path);
            Storage::delete($oldPath);
        }
        $post->delete();

        return redirect()->route('admin.blog.posts.index')->with('success', 'Post deleted successfully!');
    }

    /**
     * Toggle the publish status of the specified post.
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function togglePublish(Post $post)
    {
        $post->is_published = !$post->is_published;
        if ($post->is_published && is_null($post->published_at)) {
            $post->published_at = now();
        } elseif (!$post->is_published) {
            $post->published_at = null;
        }
        $post->save();

        $status = $post->is_published ? 'published' : 'draft';
        return back()->with('success', "Post marked as {$status} successfully!");
    }
}
