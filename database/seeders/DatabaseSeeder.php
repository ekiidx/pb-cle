<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Post;
use App\Models\Community;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();
        User::factory()->create([
            'username' => 'EK',
            'email' => 'test@example.com',
            'password' => bcrypt('rootboy!'),
            'email_verified_at' => time(),
        ]);
        User::factory()->create([
            'username' => 'Kay',
            'email' => 'kay@example.com',
            'password' => bcrypt('rootboy!'),
            'email_verified_at' => time(),
        ]);
        User::factory()->create([
            'username' => 'Will',
            'email' => 'will@example.com',
            'password' => bcrypt('rootboy!'),
            'email_verified_at' => time(),
        ]);

        Event::factory(300)->create();

        // 500K posts
        Community::factory(1)->create();
        Post::factory(100)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
        // Post::factory(10000)->create();
    
    }
}
