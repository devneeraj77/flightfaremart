<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Prepare the data for validation. This handles cleaning and defaulting values.
     */
    protected function prepareForValidation(): void
    {
        $title = $this->input('title');
        // Handle slug generation/cleaning
        $slug = $this->input('slug') ? Str::slug($this->input('slug')) : Str::slug($title);
        
        // Handle 'is_published': checkbox is missing if unchecked, so we check for presence.
        $isPublished = $this->has('is_published');
        
        // Handle 'published_at' logic based on the status
        $publishedAtInput = $this->input('published_at');
        
        if ($isPublished && empty($publishedAtInput)) {
            // If published but no date set, set it to now
            $publishedAt = now();
        } elseif (!$isPublished) {
            // If unpublished, ensure the date is null
            $publishedAt = null; 
        } else {
            // Otherwise, use the user's input date (or null if the input was blank)
            $publishedAt = $publishedAtInput ?: null;
        }

        $this->merge([
            'slug' => $slug,
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
        ]);
    }

    public function rules(): array
    {
        // Determine the Post ID for unique slug rule exclusion
        $postId = $this->route('post') ? $this->route('post')->id : null;

        return [
            // Assuming 'admins' table is used for authors based on your previous controller code
            'admin_id' => ['required', 'exists:admins,id'], 
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:posts,slug,' . $postId],
            'content' => ['required', 'string'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'image_url' => ['nullable', 'url', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['boolean'],
        ];
    }
}