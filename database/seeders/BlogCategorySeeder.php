<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Loop through 1 to 10 to generate 10 categories
        for ($i = 1; $i <= 10; $i++) {
            DB::table('blog_categories')->insert([
                'page_title' => 'Category Page ' . $i,
                'meta_desc' => 'Meta description for category ' . $i,
                'title' => 'Category ' . $i,
                'slug' => Str::slug('Category ' . $i),
                'image' => 'blog/category/default.png',
                'description' => 'Description for category ' . $i,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
