<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Loop through 1 to 10 to generate 10 articles
        for ($i = 1; $i <= 1; $i++) {
            DB::table('banners')->insert([
                'meta_desc' => 'Social media is more than just a platform—it’s a powerful tool for building connections, amplifying your brand, and driving growth. At Vexon, we provide insights and strategies to help you stand out in the ever-evolving social media landscape.',
                'title' => 'Unlocking The Secrets To Social Media Success',
                'image' => 'blog/banners/default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
