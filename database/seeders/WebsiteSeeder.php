<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Website;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Website::create(['name' => 'Tech Blog', 'url' => 'https://techblog.com']);
        Website::create(['name' => 'News Hub', 'url' => 'https://newshub.com']);
        Website::create(['name' => 'Game Hub', 'url' => 'https://gamehub.com']);
    }
}
