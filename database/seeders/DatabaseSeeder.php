<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Storage::makeDirectory('posts');
        \App\Models\Post::factory(100)->create();
    }
}
