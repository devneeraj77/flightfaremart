<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Change this to your actual authorization logic (e.g., Auth::user()->can('manage-posts'))
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Determine the Post ID if it's an update request
        $postId = $this->route('post')->id ?? null;

        return [
            'title' => ['required', 'string', 'max:255'],
            // Slug must be unique, ignoring the current post's ID during update
            'slug' => [
                'nullable', 
                'string', 
                'max:255', 
                Rule::unique('posts')->ignore($postId),
            ],
            'content' => ['required', 'string'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'user_id' => ['required', 'exists:users,id'], // Must exist in users table
            'category_id' => ['required', 'exists:categories,id'], // Must exist in categories table
            'image_url' => ['nullable', 'url', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
        ];
    }
}