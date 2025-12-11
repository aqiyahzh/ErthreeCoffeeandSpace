<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // seed pages for initial content
        $this->call(\Database\Seeders\PageSeeder::class);
        // seed categories (kopi + makanan + minuman)
        $this->call(\Database\Seeders\CategorySeeder::class);
    }
}
