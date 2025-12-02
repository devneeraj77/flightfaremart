<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicBlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()->paginate(6);
        $categories = Category::all();
        return view('blog.index', compact('posts', 'categories'));
    }

    public function show($category, $slug)
    {
        $post = Post::where('slug', $slug)->whereHas('category', function ($query) use ($category) {
            $query->where('slug', $category);
        })->firstOrFail();
        $categories = Category::all();

        return view('blog.show', compact('post', 'categories'));
    }

    public function showCategory($category)
    {
        $category = Category::where('slug', $category)->firstOrFail();
        $posts = $category->posts()->published()->paginate(6);
        $categories = Category::all();

        return view('blog.showCategory', compact('posts', 'category', 'categories'));
    }
}
