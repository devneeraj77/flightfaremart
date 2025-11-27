<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'user_id',
        'category_id',
        'image_url',
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    // --- Relationships ---

    /**
     * Get the author (User) of the Post.
     */
    public function author()
    {
        // Assuming your users table handles the 'author' role
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the category associated with the Post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // --- Scopes ---

    /**
     * Scope a query to only include published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }
}