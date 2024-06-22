<?php

namespace Database\Seeders;

// use App\Models\User;
// // use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;


use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::create(['title' => 'Laravel']);
        Category::create(['title' => 'PHP']);
        Category::create(['title' => 'JavaScript']);
        Category::create(['title' => 'Vue.js']);
        Category::create(['title' => 'React']);
        // add Javascript and CSS to list of categories
        Category::create(['title' => 'CSS']);       
        $javascriptCategory = Category::where('title', 'Javascript')->first();
        $cssCategory = Category::where('title', 'CSS')->first();

        $laravel_category = Category::where('title', 'Laravel')->first();
        $php_category = Category::where('title', 'PHP')->first();

        Post::create([
            'title' => 'Laravel 11 is released',
            'author' => 'John Doe',
            'body' => 'Laravel 11 is released and it has many new features.',
            'category_id' => $laravel_category->id,
        ]);

        $firstpost = Post::query()->latest()->first();
        //firstpost create 5 comments by different authors with some negative reviews
        $firstpost->comments()->createMany([
            ['body' => 'This is a bad post.', 'author' => 'Jane Doe'],
            ['body' => 'I hate Laravel.', 'author' => 'Brother Joe'],
            ['body' => 'This is a terrible post.', 'author' => 'John Deere'],
            ['body' => 'I dislike Laravel.', 'author' => 'Jane Maria']
        ]);

        //this is the same as the above code
        $post = new Post();
        $post->title = 'PHP 8.4 is in the making';
        $post->author = 'John Doe';
        $post->body = 'PHP 8.4 is in the making and it has many new features.';
        $post->category_id = $php_category->id;
        $post->save();

        //we are using model relationship to add comments
        $post->comments()->createMany([
            ['body' => 'This is a great post...', 'author' => 'John Doe'],
            ['body' => 'I love Laravel.', 'author' => 'Jane Doe'],
        ]);

        // Add a new blog post to the Javascript category
        $javascriptPost = new Post();
        $javascriptPost->title = 'Understanding Async/Await in JavaScript';
        $javascriptPost->author = 'Jane Developer';
        $javascriptPost->body = 'Async/Await simplifies asynchronous programming in JavaScript.';
        $javascriptPost->category_id = $javascriptCategory->id;
        $javascriptPost->save();
        $javascriptPost->comments()->createMany([
            ['body' => 'This is a great post.','author' => 'John Doe'],
        ]); 
        // Comment::factory()->count(1)->create([
        //     'post_id' => $javascriptPost->id,
        //     'body' => 'This is a great js post.',
        //     'author' => 'John Doe',
        // ]);

        // Add a new blog post to the CSS category
        $cssPost = new Post();
        $cssPost->title = 'Mastering Flexbox for Responsive Design';
        $cssPost->author = 'John Designer';
        $cssPost->body = 'Flexbox is a powerful layout tool for designing responsive websites.';
        $cssPost->category_id = $cssCategory->id;
        $cssPost->save();
        Comment::factory()->count(75)->create([
            // 'body' => $faker->paragraph,
            // 'author' => $faker->name,
        ]);
    }
}