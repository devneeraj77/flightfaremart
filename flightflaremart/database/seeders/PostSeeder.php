<?php

namespace Database\Seeders;

use App\Http\Requests\Admin\Blog\CategoryRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $adminUser = User::factory()->create([
            'name' => 'Admin Author',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Use 'password' for easy testing
            // Assuming you have an 'is_admin' field or similar logic
            // 'is_admin' => true, 
        ]);

        $users = User::factory(2)->create();
        $users->push($adminUser); // Ensure the admin is in the collection

        $user1 = $users->first();
        $user2 = $users->last();
         // 2. Create Mock Categories
        $category1 = CategoryRequest::firstOrCreate(
            ['name' => 'Technology Trends'], 
            ['slug' => 'technology-trends']
        );

        $category2 = CategoryRequest::firstOrCreate(
            ['name' => 'Productivity Hacks'], 
            ['slug' => 'productivity-hacks']
        );
        
        $category3 = CategoryRequest::firstOrCreate(
            ['name' => 'Design Principles'], 
            ['slug' => 'design-principles']
        );

        // 3. Create Mock Posts (3 posts linked to categories and users)
        
        // Post 1: Published, linked to Tech, by Admin
        $title1 = "The Future of AI in Web Development";
        Post::create([
            'user_id' => $adminUser->id,
            'category_id' => $category1->id,
            'title' => $title1,
            'slug' => Str::slug($title1),
            'content' => 'The rapid integration of AI tools like GitHub Copilot and large language models is changing how we write code. This post explores the shift from manual coding to AI-assisted workflows and what it means for the next generation of developers. We delve into how AI can optimize routine tasks, allowing engineers to focus on complex problem-solving and architectural design.',
            'excerpt' => 'A deep dive into how AI is rapidly reshaping web development practices, focusing on tools that enhance productivity and creative freedom.',
            'image_url' => 'https://placehold.co/800x400/0000FF/FFFFFF?text=AI+Future',
            'published_at' => Carbon::now()->subDays(5),
            'is_published' => true,
        ]);

        // Post 2: Draft, linked to Productivity, by User 1
        $title2 = "5 Habits of Highly Effective Remote Teams";
        Post::create([
            'user_id' => $user1->id,
            'category_id' => $category2->id,
            'title' => $title2,
            'slug' => Str::slug($title2),
            'content' => 'Maintaining high productivity in a fully remote environment requires discipline and the right tools. We break down the five essential habits, including asynchronous communication, scheduled focus time, and the importance of digital documentation. These practices help minimize distractions and maximize output across different time zones.',
            'excerpt' => 'Discover the essential strategies and routines that set successful remote teams apart, from communication protocols to deep work scheduling.',
            'image_url' => 'https://placehold.co/800x400/00FF00/000000?text=Remote+Work',
            'published_at' => null, // Draft
            'is_published' => false, // Draft
        ]);

        // Post 3: Scheduled (Published_at in future), linked to Design, by User 2
        $title3 = "The Psychology Behind Dark Mode Adoption";
        Post::create([
            'user_id' => $user2->id,
            'category_id' => $category3->id,
            'title' => $title3,
            'slug' => Str::slug($title3),
            'content' => 'Dark mode is more than just a visual trend; it taps into cognitive psychology related to eye strain and aesthetic preference. This article explores the science of low-light UI, the impact on OLED screens, and why users are overwhelmingly switching to darker interfaces.',
            'excerpt' => 'Exploring the scientific, ergonomic, and aesthetic reasons driving the massive shift towards dark mode in modern applications and operating systems.',
            'image_url' => 'https://placehold.co/800x400/333333/EEEEEE?text=Dark+Mode',
            'published_at' => Carbon::now()->addDays(2), // Scheduled for the future
            'is_published' => true, // Will be published when 'published_at' passes
        ]);

        $this->command->info('Blog mock data (3 Posts, 3 Categories, 3 Users) seeded successfully!');
    }
}
