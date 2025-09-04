<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BlogArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Loop through 1 to 10 to generate 10 articles
        for ($i = 1; $i <= 10; $i++) {
            DB::table('blog_articles')->insert([
                'blog_category_id' => rand(1, 10),  // Randomly assigns a category from 1 to 10
                'page_title' => 'Article Page ' . $i,
                'meta_desc' => 'Meta description for article ' . $i,
                'title' => 'Article ' . $i,
                'slug' => Str::slug('Article ' . $i),
               'image' => 'blog/article/default.png',
                'description' => 'Description for article ' . $i,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
