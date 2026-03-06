<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ], [
            'password' => bcrypt('password'),
        ]);

        $categories = collect([
            'Coffee Shop',
            'heavy meal cafe',
            'Work-Friendly Cafe',
            'Dessert Cafe',
            'Matcha Cafe',
        ])->map(function ($name) {
            return Category::firstOrCreate(['name' => $name]);
        });

        if (Post::count() === 0) {
            Post::create([
                'title' => 'Topgrind',
                'body' => 'Spacious seating, smooth house blend, and great natural light for afternoon coffee sessions.',
                'meta_description' => 'A relaxing cafe with balanced coffee and calm vibes.',
                'location' => 'Yayasan',
                'meta_author' => 'Test User',
                'category_id' => $categories->firstWhere('name', 'Coffee Shop')->id,
            ]);

            Post::create([
                'title' => 'Kyo',
                'body' => 'Known for their best matcha latte in the town.',
                'meta_description' => 'A cozy spot for matcha lovers.',
                'location' => 'Menglait',
                'meta_author' => 'Test User',
                'category_id' => $categories->firstWhere('name', 'Matcha Cafe')->id,
            ]);

            Post::create([
                'title' => 'Royal RVS cafe',
                'body' => 'A cozy cafe known for its hearty meals and warm atmosphere.',
                'meta_description' => 'A welcoming spot for a satisfying meal.',
                'location' => 'Madang',
                'meta_author' => 'Test User',
                'category_id' => $categories->firstWhere('name', 'heavy meal cafe')->id,
            ]);

            Post::create([
                'title' => 'Bake Street Cafe',
                'body' => 'Reliable wifi, many charging spots, and quiet corners make this cafe ideal for study or remote work.',
                'meta_description' => 'A productive cafe setup for focus sessions.',
                'location' => 'Batu Besurat',
                'meta_author' => 'Test User',
                'category_id' => $categories->firstWhere('name', 'Work-Friendly Cafe')->id,
            ]);
        }

        $categoryIds = $categories->pluck('id')->all();

        Post::whereNull('category_id')->get()->each(function (Post $post) use ($categoryIds) {
            $post->update([
                'category_id' => $categoryIds[array_rand($categoryIds)],
            ]);
        });
    }
}
